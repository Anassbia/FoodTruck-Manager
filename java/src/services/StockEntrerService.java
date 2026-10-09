package services;

import java.sql.*;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.time.format.DateTimeParseException;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.Scanner;

import main.Database;
import models.Produit;
import models.StockEntrer;

public class StockEntrerService extends StockService{
	
   private Scanner scanner = new Scanner(System.in);
    
   public void ajouterStockEntrer() {
	   
    Produit produit = new ProduitService().rechercherProduitParNom();

    if (produit == null) {
        
        return;
    }

    StockEntrer stock = new StockEntrer(produit.getType());

    double prixUnitaire = stock.getPrix() / stock.getQuantite();

    String insertStockSql = """
        INSERT INTO stockEntrer (id_produit, quantite, quantiteActuel, date_reception, dateExpiration, prix)
        VALUES (?, ?, ?, ?, ?, ?)
    """;

    String updateProduitSql = """
        UPDATE produit 
        SET quantite = quantite + ?, 
            prix_unitaire = ?, 
            date_expiration = ?
        WHERE id_produit = ?
    """;

    try (Connection conn = Database.getConnection()) {

        // 1. Insertion dans stockEntrer
        try (PreparedStatement pstmt = conn.prepareStatement(insertStockSql)) {
            pstmt.setInt(1, produit.getIdProduit());
            pstmt.setInt(2, stock.getQuantite());
            pstmt.setInt(3, stock.getQuantiteActuel());
            pstmt.setDate(4, java.sql.Date.valueOf(stock.getDateReception()));
            if (stock.getDateExpiration() != null) {
                pstmt.setDate(5, java.sql.Date.valueOf(stock.getDateExpiration()));
            } else {
                pstmt.setNull(5, java.sql.Types.DATE);
            }

            pstmt.setDouble(6, stock.getPrix());
            pstmt.executeUpdate();
        }

        // 2. Mise à jour du produit
        try (PreparedStatement pstmtUpdate = conn.prepareStatement(updateProduitSql)) {
            pstmtUpdate.setInt(1, stock.getQuantite());
            pstmtUpdate.setDouble(2, prixUnitaire);

            if (stock.getDateExpiration() != null) {
                pstmtUpdate.setDate(3, java.sql.Date.valueOf(stock.getDateExpiration()));
            } else {
                pstmtUpdate.setNull(3, java.sql.Types.DATE);
            }

            pstmtUpdate.setInt(4, produit.getIdProduit());
            pstmtUpdate.executeUpdate();
        }

        System.out.println("✅ Stock d’entrée ajouté et produit mis à jour !");
    } catch (SQLException e) {
        System.out.println("❌ Erreur SQL : " + e.getMessage());
    }
}

   public void modifierStockEntrer() {
	    ProduitService produitService = new ProduitService();
	    StockEntrerService stockService = new StockEntrerService();

	    Produit produit = produitService.rechercherProduitParNom();

	    if (produit == null || produit.getIdProduit() == 0) {
	        System.out.println("❌ Produit introuvable !");
	        return;
	    }

	    DateTimeFormatter formatter = DateTimeFormatter.ofPattern("yyyy-MM-dd");
	    LocalDate receptionDate = null;

	    // Validation pour la date de réception
	    while (true) {
	        System.out.print("Date de réception (yyyy-MM-dd) : ");
	        String inputReception = scanner.nextLine();

	        try {
	            receptionDate = LocalDate.parse(inputReception, formatter);
	            break; // Date valide, sortir de la boucle
	        } catch (DateTimeParseException e) {
	            System.out.println("❌ Format invalide. Veuillez entrer la date au format yyyy-MM-dd.");
	        }
	    }

	    StockEntrer stock = stockService.chercherStock(produit.getIdProduit(), receptionDate);

	    if (stock == null) {
	        System.out.println("❌ Stock introuvable pour ce produit et cette date !");
	        return;
	    }

	    // Affichage du stock
	    afficherListeStock(List.of(stock));

	    if (stock.getQuantite() != stock.getQuantiteActuel()) {
	        System.out.println("❌ Modification interdite : ce stock a déjà été consommé.");
	        return;
	    }

	    // Validation de la nouvelle quantité
	    int nouvelleQuantite = stock.getQuantite();
	    while (true) {
	        System.out.print("Nouvelle quantité (vide = " + stock.getQuantite() + ") : ");
	        String qteInput = scanner.nextLine();
	        if (qteInput.isBlank()) {
	            break; // Laisser la valeur par défaut si le champ est vide
	        }

	        try {
	            nouvelleQuantite = Integer.parseInt(qteInput);
	            if (nouvelleQuantite < 0) {
	                System.out.println("❌ Quantité invalide. Veuillez entrer un nombre positif.");
	            } else {
	                break; // Quantité valide
	            }
	        } catch (NumberFormatException e) {
	            System.out.println("❌ Entrée invalide pour la quantité. Veuillez entrer un nombre entier.");
	        }
	    }

	    int difference = nouvelleQuantite - stock.getQuantite();

	    // Validation du nouveau prix
	    double nouveauPrix = stock.getPrix();
	    while (true) {
	        System.out.print("Nouveau prix total (DH) (vide = " + stock.getPrix() + ") : ");
	        String prixInput = scanner.nextLine();
	        if (prixInput.isBlank()) {
	            break; // Laisser la valeur par défaut si le champ est vide
	        }

	        try {
	            nouveauPrix = Double.parseDouble(prixInput);
	            if (nouveauPrix < 0) {
	                System.out.println("❌ Prix invalide. Veuillez entrer un prix positif.");
	            } else {
	                break; // Prix valide
	            }
	        } catch (NumberFormatException e) {
	            System.out.println("❌ Entrée invalide pour le prix. Veuillez entrer un nombre.");
	        }
	    }

	    LocalDate nouvelleDateExpiration = stock.getDateExpiration();
	    if ("alimentaire".equalsIgnoreCase(produit.getType())) {
	        // Validation de la date d'expiration pour les produits alimentaires
	        while (true) {
	            System.out.print("Nouvelle date d'expiration (yyyy-MM-dd, vide = " +
	                    (nouvelleDateExpiration != null ? nouvelleDateExpiration : "Aucune") + ") : ");
	            String expInput = scanner.nextLine();
	            if (expInput.isBlank()) {
	                break; // Laisser la valeur par défaut si le champ est vide
	            }

	            try {
	                nouvelleDateExpiration = LocalDate.parse(expInput, formatter);
	                break; // Date valide
	            } catch (DateTimeParseException e) {
	                System.out.println("❌ Format de date invalide. Veuillez entrer la date au format yyyy-MM-dd.");
	            }
	        }
	    }

	    // Validation de la nouvelle date de réception
	    while (true) {
	        System.out.print("Nouvelle date de réception (yyyy-MM-dd, vide = " + stock.getDateReception() + ") : ");
	        String newRecInput = scanner.nextLine();
	        if (newRecInput.isBlank()) {
	            break; // Laisser la valeur par défaut si le champ est vide
	        }

	        try {
	            receptionDate = LocalDate.parse(newRecInput, formatter);
	            break; // Date valide
	        } catch (DateTimeParseException e) {
	            System.out.println("❌ Format de date invalide. Veuillez entrer la date au format yyyy-MM-dd.");
	        }
	    }

	    // Calcul du prix unitaire
	    double prixUnitaire = (nouvelleQuantite != 0) ? nouveauPrix / nouvelleQuantite : 0;

	    // Mise à jour dans la base de données
	    String updateStockSql = """
	        UPDATE stockEntrer
	        SET quantite = ?, quantiteActuel = ?, prix = ?, dateExpiration = ?, date_reception = ?
	        WHERE id_ST = ?
	    """;

	    try (Connection conn = Database.getConnection();
	         PreparedStatement stmt = conn.prepareStatement(updateStockSql)) {

	        stmt.setInt(1, nouvelleQuantite);
	        stmt.setInt(2, nouvelleQuantite);
	        stmt.setDouble(3, nouveauPrix);
	        if (nouvelleDateExpiration != null) {
	            stmt.setDate(4, java.sql.Date.valueOf(nouvelleDateExpiration));
	        } else {
	            stmt.setNull(4, java.sql.Types.DATE);
	        }
	        stmt.setDate(5, java.sql.Date.valueOf(receptionDate));
	        stmt.setInt(6, stock.getIdST());

	        int rows = stmt.executeUpdate();
	        if (rows > 0) {
	            System.out.println("✅ StockEntrer mis à jour !");
	        }

	        String updateProduitSql = """
	            UPDATE produit SET quantite = quantite + ?, prix_unitaire = ? WHERE id_produit = ?
	        """;

	        try (PreparedStatement produitStmt = conn.prepareStatement(updateProduitSql)) {
	            produitStmt.setInt(1, difference);
	            produitStmt.setDouble(2, prixUnitaire);
	            produitStmt.setInt(3, produit.getIdProduit());
	            produitStmt.executeUpdate();
	            System.out.println("✅ Produit mis à jour !");
	        }

	    } catch (SQLException e) {
	        System.out.println("❌ Erreur SQL : " + e.getMessage());
	    }
	}

   public void afficherStocksEntrerProduit() {
    Produit produit = new ProduitService().rechercherProduitParNom();

    if (produit == null || produit.getIdProduit() == 0) {
        return;
    }

    String sql = """
        SELECT id_ST, quantite, quantiteActuel, prix, date_reception, dateExpiration
        FROM stockEntrer
        WHERE id_produit = ? AND quantiteActuel > 0
        ORDER BY date_reception DESC
    """;

    try (Connection conn = Database.getConnection();
    	     PreparedStatement stmt = conn.prepareStatement(sql)) {

    	    stmt.setInt(1, produit.getIdProduit());
    	    ResultSet rs = stmt.executeQuery();

    	    List<StockEntrer> stocks = new ArrayList<>();

    	    while (rs.next()) {
    	        int idST = rs.getInt("id_ST");
    	        int quantite = rs.getInt("quantite");
    	        int quantiteActuel = rs.getInt("quantiteActuel");
    	        double prix = rs.getDouble("prix");
    	        LocalDate dateReception = rs.getDate("date_reception").toLocalDate();
    	        Date exp = rs.getDate("dateExpiration");
    	        LocalDate dateExpiration = (exp != null) ? ((java.sql.Date) exp).toLocalDate() : null;

    	        StockEntrer stock = new StockEntrer(idST, produit.getIdProduit(), quantite, quantiteActuel, prix, dateReception, dateExpiration);
    	        stocks.add(stock);
    	    }

    	    System.out.println("\n📦 Stocks pour le produit : " + produit.getNom());

    	    if (stocks.isEmpty()) {
    	        System.out.println("❌ Aucun stock d'entrée trouvé pour ce produit.");
    	    } else {
    	        afficherListeStock(stocks); 
    	    }

    	} catch (SQLException e) {
    	    System.out.println("❌ Erreur SQL : " + e.getMessage());
    	}

}

   public void chercherStockParDate() {
	    ProduitService produitService = new ProduitService();
	    Produit produit = produitService.rechercherProduitParNom();

	    if (produit == null || produit.getIdProduit() == 0) {
	        System.out.println("❌ Produit introuvable !");
	        return;
	    }

	    // Validation de la date
	    LocalDate dateReception = null;
	    while (true) {
	        System.out.print("Entrez la date de réception (yyyy-MM-dd) : ");
	        String inputDate = scanner.nextLine();

	        try {
	            dateReception = LocalDate.parse(inputDate);
	            break; // Sortir de la boucle si la date est valide
	        } catch (DateTimeParseException e) {
	            System.out.println("❌ Format de date invalide. Utilisez le format AAAA-MM-JJ.");
	        }
	    }

	    String sql = """
	        SELECT id_ST, quantite, quantiteActuel, prix, dateExpiration, date_reception
	        FROM stockEntrer
	        WHERE id_produit = ? AND date_reception = ?
	    """;

	    try (Connection conn = Database.getConnection();
	         PreparedStatement stmt = conn.prepareStatement(sql)) {

	        stmt.setInt(1, produit.getIdProduit());
	        stmt.setDate(2, java.sql.Date.valueOf(dateReception));

	        ResultSet rs = stmt.executeQuery();

	        List<StockEntrer> stocks = new ArrayList<>();

	        while (rs.next()) {
	            int idST = rs.getInt("id_ST");
	            int quantite = rs.getInt("quantite");
	            int quantiteActuel = rs.getInt("quantiteActuel");
	            double prix = rs.getDouble("prix");
	            LocalDate expiration = (rs.getDate("dateExpiration") != null) ? rs.getDate("dateExpiration").toLocalDate() : null;
	            LocalDate reception = rs.getDate("date_reception").toLocalDate();

	            StockEntrer stock = new StockEntrer(idST, produit.getIdProduit(), quantite, quantiteActuel, prix, reception, expiration);
	            stocks.add(stock);
	        }

	        if (stocks.isEmpty()) {
	            System.out.println("❌ Aucun stock trouvé pour ce produit à cette date.");
	        } else {
	            afficherListeStock(stocks); // Affichage de la liste des stocks
	        }

	    } catch (SQLException e) {
	        System.out.println("❌ Erreur SQL : " + e.getMessage());
	    }
	}
  
   public void supprimerStock() {
	    ProduitService produitService = new ProduitService();
	    Produit produit = produitService.rechercherProduitParNom();

	    if (produit == null || produit.getIdProduit() == 0) {
	        System.out.println("❌ Produit introuvable !");
	        return;
	    }

	    // Validation de la date
	    LocalDate dateReception = null;
	    while (true) {
	        System.out.print("Entrez la date de réception (yyyy-MM-dd) du stock à supprimer : ");
	        String inputDate = scanner.nextLine();

	        try {
	            dateReception = LocalDate.parse(inputDate);
	            break; // Sortir de la boucle si la date est valide
	        } catch (DateTimeParseException e) {
	            System.out.println("❌ Format de date invalide. Utilisez yyyy-MM-dd.");
	        }
	    }

	    StockEntrerService stockService = new StockEntrerService();
	    StockEntrer stock = stockService.chercherStock(produit.getIdProduit(), dateReception);

	    if (stock == null) {
	        System.out.println("❌ Aucun stock trouvé pour ce produit à cette date !");
	        return;
	    }

	    // Affichage du stock
	    afficherListeStock(List.of(stock));

	    // Vérification que le stock n'a pas été utilisé
	    if (stock.getQuantite() != stock.getQuantiteActuel()) {
	        System.out.println("❌ Suppression interdite : Ce stock a déjà été utilisé.");
	        return;
	    }

	    // Confirmation de la suppression
	    System.out.print("⚠️ Êtes-vous sûr de vouloir supprimer ce stock ? (oui/non) : ");
	    String confirmation = scanner.nextLine().toLowerCase();
	    if (!confirmation.equals("oui")) {
	        System.out.println("❌ Suppression annulée.");
	        return;
	    }

	    int totalQuantite = stock.getQuantite();

	    // Suppression du stock
	    try {
	        stockService.supprimerStockParId(stock.getIdST());

	        // Mise à jour de la quantité du produit
	        stockService.mettreAJourQuantiteProduit(produit.getIdProduit(), -totalQuantite);

	        System.out.println("✅ Le stock a été supprimé avec succès !");
	        System.out.println("✅ Quantité totale retirée du produit : " + totalQuantite);
	    } catch (SQLException e) {
	        System.out.println("❌ Erreur SQL lors de la suppression du stock : " + e.getMessage());
	    }
	}

   public void supprimerStockParId(int idST) throws SQLException {
	    String deleteSql = "DELETE FROM stockEntrer WHERE id_ST = ?";
	    try (Connection conn = Database.getConnection();
	         PreparedStatement stmt = conn.prepareStatement(deleteSql)) {
	        stmt.setInt(1, idST);
	        stmt.executeUpdate();
	    }
	}

   public void mettreAJourQuantiteProduit(int idProduit, int quantite) throws SQLException {
	    String updateSql = "UPDATE produit SET quantite = quantite - ? WHERE id_produit = ?";
	    try (Connection conn = Database.getConnection();
	         PreparedStatement stmt = conn.prepareStatement(updateSql)) {
	        stmt.setInt(1, quantite);
	        stmt.setInt(2, idProduit);
	        stmt.executeUpdate();
	    }
	}
  
   public List<StockEntrer> chercherStocksDisponibles(int idProduit) {
	    List<StockEntrer> stocks = new ArrayList<>();
	    String sql = """
	        SELECT * FROM stockEntrer
	        WHERE id_produit = ?
	          AND quantiteActuel > 0
	          AND (dateExpiration IS NULL OR dateExpiration >= CURRENT_DATE)
	        ORDER BY date_reception ASC
	    """;

	    try (Connection conn = Database.getConnection();
	         PreparedStatement stmt = conn.prepareStatement(sql)) {

	        stmt.setInt(1, idProduit);
	        ResultSet rs = stmt.executeQuery();

	        while (rs.next()) {
	            int idST = rs.getInt("id_ST");
	            int quantite = rs.getInt("quantite");
	            int quantiteActuel = rs.getInt("quantiteActuel");
	            double prix = rs.getDouble("prix");
	            LocalDate dateReception = rs.getDate("date_reception").toLocalDate();
	            LocalDate dateExpiration = (rs.getDate("dateExpiration") != null) ?
	                    rs.getDate("dateExpiration").toLocalDate() : null;

	            stocks.add(new StockEntrer(idST, idProduit, quantite, quantiteActuel, prix, dateReception, dateExpiration));
	        }

	    } catch (SQLException e) {
	        System.out.println("❌ Erreur SQL : " + e.getMessage());
	    }

	    return stocks;
	}
 
}
