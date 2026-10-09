package services;

import java.sql.*;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.time.format.DateTimeParseException;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

import main.Database;
import models.Produit;
import models.StockEntrer;
import models.StockSortir;

public class StockSortirService extends StockService{
	
    private Scanner scanner = new Scanner(System.in);

    public void stockSorti() {
    	
        ProduitService produitService = new ProduitService();
        StockEntrerService stockService = new StockEntrerService();

        Produit produit = produitService.rechercherProduitParNom();
        if (produit == null) return;

        List<StockEntrer> stocksDisponibles = stockService.chercherStocksDisponibles(produit.getIdProduit());

        if (stocksDisponibles.isEmpty()) {
            System.out.println("❌ Aucun stock disponible pour ce produit !");
            return;
        }

        afficherListeStock(stocksDisponibles);

        Scanner scanner = new Scanner(System.in);
        System.out.print("Quantité à sortir : ");
        int reste = scanner.nextInt();
        scanner.nextLine(); // Clear buffer

        if (reste <= 0) {
            System.out.println("❌ Quantité invalide !");
            return;
        }

        List<StockSortir> sorties = new ArrayList<>();
        for (StockEntrer se : stocksDisponibles) {
            if (reste == 0) break;
            int utiliser = Math.min(reste, se.getQuantiteActuel());
            sorties.add(new StockSortir(se.getIdST(), produit.getIdProduit(), utiliser, LocalDate.now()));
            reste -= utiliser;
        }

        if (reste > 0) {
            System.out.println("❌ Quantité insuffisante dans le stock !");
            return;
        }

        try (Connection conn = Database.getConnection()) {
            conn.setAutoCommit(false);

            for (StockSortir ss : sorties) {
                // Mettre à jour le stock entrant
                String updateStock = "UPDATE stockEntrer SET quantiteActuel = quantiteActuel - ? WHERE id_ST = ?";
                try (PreparedStatement updateStmt = conn.prepareStatement(updateStock)) {
                    updateStmt.setInt(1, ss.getQuantite());
                    updateStmt.setInt(2, ss.getIdST());
                    updateStmt.executeUpdate();
                }

                // Insérer dans stockSortir
                String insertSortir = "INSERT INTO stockSortir(id_ST, quantite, date_sortir) VALUES (?, ?, ?)";
                try (PreparedStatement insertStmt = conn.prepareStatement(insertSortir)) {
                    insertStmt.setInt(1, ss.getIdST());
                    insertStmt.setInt(2, ss.getQuantite());
                    insertStmt.setDate(3, java.sql.Date.valueOf(ss.getDateSortir()));
                    insertStmt.executeUpdate();
                }
            }

            // Mettre à jour le stock du produit
            String updateProduit = "UPDATE produit SET quantite = quantite - ? WHERE id_produit = ?";
            try (PreparedStatement prodStmt = conn.prepareStatement(updateProduit)) {
                prodStmt.setInt(1, sorties.stream().mapToInt(StockSortir::getQuantite).sum());
                prodStmt.setInt(2, produit.getIdProduit());
                prodStmt.executeUpdate();
            }

            conn.commit();
            System.out.println("✅ Stock sorti avec succès !");

        } catch (Exception e) {
            System.out.println("❌ Erreur lors de la sortie de stock : " + e.getMessage());
            e.printStackTrace();
        }
    }
    
    public void modifierStockSorti() {
        Scanner scanner = new Scanner(System.in);
        ProduitService produitService = new ProduitService();
        StockEntrerService stockEntrerService = new StockEntrerService();

        Produit produit = produitService.rechercherProduitParNom();
        if (produit == null) return;

        LocalDate dateSortie = null;
        do {
            System.out.print("📅 Entrez la date de sortie (format YYYY-MM-DD) : ");
            String input = scanner.nextLine();

            try {
                dateSortie = LocalDate.parse(input);
                break;
            } catch (DateTimeParseException e) {
                System.out.println("❌ Format de date invalide. Veuillez respecter le format YYYY-MM-DD !");
            }
        } while (true);

        List<StockSortir> sorties = getSortiesParProduitEtDate(produit.getIdProduit(), dateSortie);
        if (sorties.isEmpty()) {
            System.out.println("❌ Aucune sortie trouvée pour cette date.");
            return;
        }

        System.out.println("╔══════════╦═══════════════════╦════════════════════╗");
        System.out.println("║N° Entrer ║ Quantité Sortie   ║ Date de Sortie     ║");
        System.out.println("╠══════════╬═══════════════════╬════════════════════╣");
        for (StockSortir ss : sorties) {
            System.out.printf("║ %-8d ║ %-17d ║ %-18s ║\n",
                     ss.getIdST(), ss.getQuantite(), ss.getDateSortir());
        }
        System.out.println("╚══════════╩═══════════════════╩════════════════════╝");

        for (StockSortir ss : sorties) {
            int nouvelleQuantite = -1;
            do {
                System.out.printf("➡ Nouvelle quantité pour Stock Sortie (actuelle: %d) : ", ss.getQuantite());

                if (scanner.hasNextInt()) {
                    nouvelleQuantite = scanner.nextInt();
                    scanner.nextLine(); // nettoyer le buffer

                    if (nouvelleQuantite >= 0) {
                        break;
                    } else {
                        System.out.println("❌ La quantité doit être un nombre positif !");
                    }
                } else {
                    System.out.println("❌ Entrée invalide, veuillez saisir un nombre !");
                    scanner.nextLine(); // vider le mauvais input
                }
            } while (true);

            int ancienneQuantite = ss.getQuantite();
            int difference = nouvelleQuantite - ancienneQuantite;

            try (Connection conn = Database.getConnection()) {
                conn.setAutoCommit(false); // début de transaction

                if (nouvelleQuantite == 0) {
                    // Supprimer la sortie si la nouvelle quantité est 0
                    try (PreparedStatement deleteStmt = conn.prepareStatement(
                            "DELETE FROM stockSortir WHERE id_SS = ?")) {
                        deleteStmt.setInt(1, ss.getIdSS());
                        deleteStmt.executeUpdate();
                    }
                } else {
                    // Mettre à jour la quantité sortie
                    try (PreparedStatement updateStmt = conn.prepareStatement(
                            "UPDATE stockSortir SET quantite = ? WHERE id_SS = ?")) {
                        updateStmt.setInt(1, nouvelleQuantite);
                        updateStmt.setInt(2, ss.getIdSS());
                        updateStmt.executeUpdate();
                    }
                }

                // Mettre à jour le stock entrer (quantiteActuel)
                try (PreparedStatement updateStock = conn.prepareStatement(
                        "UPDATE stockEntrer SET quantiteActuel = quantiteActuel - ? WHERE id_ST = ?")) {
                    updateStock.setInt(1, difference);
                    updateStock.setInt(2, ss.getIdST());
                    updateStock.executeUpdate();
                }

                // Mettre à jour le stock produit
                try (PreparedStatement updateProduit = conn.prepareStatement(
                        "UPDATE produit SET quantite = quantite - ? WHERE id_produit = ?")) {
                    updateProduit.setInt(1, difference);
                    updateProduit.setInt(2, produit.getIdProduit());
                    updateProduit.executeUpdate();
                }

                conn.commit(); // valider la transaction
                System.out.println("✅ Modification appliquée avec succès pour ID_SS " + ss.getIdSS());

            } catch (SQLException e) {
                System.out.println("❌ Erreur lors de la modification : " + e.getMessage());
                e.printStackTrace();
            }
        }
    }

    public List<StockSortir> getSortiesParProduitEtDate(int idProduit, LocalDate dateSortie) {
        List<StockSortir> sorties = new ArrayList<>();

        String sql = """
            SELECT ss.id_SS, ss.id_ST, ss.quantite, ss.date_sortir, se.id_produit
            FROM stockSortir ss
            JOIN stockEntrer se ON ss.id_ST = se.id_ST
            WHERE se.id_produit = ? AND ss.date_sortir = ?
            ORDER BY ss.date_sortir DESC
        """;

        try (Connection conn = Database.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {

            stmt.setInt(1, idProduit);
            stmt.setDate(2, java.sql.Date.valueOf(dateSortie));

            ResultSet rs = stmt.executeQuery();
            while (rs.next()) {
                int idSS = rs.getInt("id_SS");
                int idST = rs.getInt("id_ST");
                int quantite = rs.getInt("quantite");
                LocalDate date_sortir = rs.getDate("date_sortir").toLocalDate();

                StockSortir stockSortir = new StockSortir(idST, idProduit, quantite, date_sortir);
                stockSortir.setIdSS(idSS);

                sorties.add(stockSortir); 
            }

        } catch (SQLException e) {
            System.out.println("❌ Erreur lors de la récupération des sorties : " + e.getMessage());
        }

        return sorties;
    }
    
    public void afficherStockSortiParDate() {
        Scanner scanner = new Scanner(System.in);
        ProduitService produitService = new ProduitService();
        Produit produit = produitService.rechercherProduitParNom();
        if (produit == null) return;

        DateTimeFormatter formatter = DateTimeFormatter.ofPattern("yyyy-MM-dd");
        LocalDate dateSortie = null;

        while (true) {
            System.out.print("Entrez la date de sortie (yyyy-MM-dd) : ");
            String dateStr = scanner.nextLine();

            try {
                dateSortie = LocalDate.parse(dateStr, formatter);
                break; 
            } catch (DateTimeParseException e) {
                System.out.println("❌ Format invalide. Veuillez entrer la date au format yyyy-MM-dd.");
            }
        }


        String sql = """
            SELECT ss.id_SS, ss.id_ST, ss.quantite, ss.date_sortir
            FROM stockSortir ss
            JOIN stockEntrer se ON ss.id_ST = se.id_ST
            WHERE se.id_produit = ? AND ss.date_sortir = ?
            ORDER BY ss.date_sortir DESC
        """;

        try (Connection conn = Database.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {

            stmt.setInt(1, produit.getIdProduit());
            stmt.setDate(2, java.sql.Date.valueOf(dateSortie));

            ResultSet rs = stmt.executeQuery();

            List<StockSortir> sorties = new ArrayList<>();

            while (rs.next()) {
                int idSS = rs.getInt("id_SS");
                int idST = rs.getInt("id_ST");
                int quantite = rs.getInt("quantite");
                LocalDate date = rs.getDate("date_sortir").toLocalDate();

                sorties.add(new StockSortir(idSS, idST, quantite, date));
            }

            if (sorties.isEmpty()) {
                System.out.println("❌ Aucun stock sorti trouvé pour cette date.");
                return;
            }

            System.out.println("╔═══════════════════╦════════════════════╗");
            System.out.println("║ Quantité Sortie   ║ Date de Sortie     ║");
            System.out.println("╠═══════════════════╬════════════════════╣");
            for (StockSortir ss : sorties) {
                System.out.printf("║ %-17d ║ %-18s ║\n",
                     ss.getQuantite(), ss.getDateSortir());
            }
            System.out.println("╚═══════════════════╩════════════════════╝");

        } catch (SQLException e) {
            System.out.println("❌ Erreur SQL : " + e.getMessage());
        }
    }

}
