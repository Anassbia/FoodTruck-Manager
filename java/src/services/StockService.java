package services;

import java.sql.Connection;
import java.sql.Date;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.time.LocalDate;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;

import main.Database;
import models.StockEntrer;

public class StockService {
	
	public StockEntrer chercherStock(int idProduit, LocalDate dateReception) {
    String sql = """
        SELECT * 
        FROM stockEntrer 
        WHERE id_produit = ? AND date_reception = ?
    """;

    try (Connection conn = Database.getConnection();
         PreparedStatement stmt = conn.prepareStatement(sql)) {

        stmt.setInt(1, idProduit);
        stmt.setDate(2, java.sql.Date.valueOf(dateReception));

        ResultSet rs = stmt.executeQuery();
        if (rs.next()) {
            int idST = rs.getInt("id_ST");
            int quantite = rs.getInt("quantite");
            int quantiteActuel = rs.getInt("quantiteActuel");
            double prix = rs.getDouble("prix");
            LocalDate dateReception1 = rs.getDate("date_reception").toLocalDate();

            Date exp = rs.getDate("dateExpiration");
            LocalDate dateExpiration = (exp != null) ? exp.toLocalDate() : null;

            return new StockEntrer(
                idST,
                idProduit,
                quantite,
                quantiteActuel,
                prix,
                dateReception1,
                dateExpiration
            );
        }

    } catch (SQLException e) {
        System.out.println("❌ Erreur SQL : " + e.getMessage());
    }

    return null;
}

	public static void afficherListeStock(List<StockEntrer> stocks) {
	    System.out.println("╔════════════╦════════════╦════════════════════╦════════════╦════════════════════╦════════════════════╗");
	    System.out.println("║ ID Stock   ║ Quantité   ║ Quantité Actuelle  ║ Prix (DH)  ║ Date de Réception  ║ Date d'expiration  ║");
	    System.out.println("╠════════════╬════════════╬════════════════════╬════════════╬════════════════════╬════════════════════╣");

	    for (StockEntrer stock : stocks) {
	        System.out.printf("║ %-10d ║ %-10d ║ %-18d ║ %-10.2f ║ %-18s ║ %-18s ║\n",
	            stock.getIdST(), stock.getQuantite(), stock.getQuantiteActuel(), stock.getPrix(),
	            stock.getDateReception() != null ? stock.getDateReception().toString() : "Null",
	            stock.getDateExpiration() != null ? stock.getDateExpiration().toString() : "Null"
	        );
	    }

	    System.out.println("╚════════════╩════════════╩════════════════════╩════════════╩════════════════════╩════════════════════╝");
	}

	public void afficherConsommationProduit() throws SQLException {

        Connection connection = Database.getConnection();

        Scanner scanner = new Scanner(System.in);
        System.out.print("Entrez le nom du produit: ");
        String nomProduit = scanner.nextLine();

        String produitQuery = "SELECT id_produit FROM produit WHERE nom = ?";
        PreparedStatement psProduit = connection.prepareStatement(produitQuery);
        psProduit.setString(1, nomProduit);
        ResultSet rsProduit = psProduit.executeQuery();

        int produitId = -1;
        if (rsProduit.next()) {
            produitId = rsProduit.getInt("id_produit");
        } else {
            System.out.println("Produit non trouvé.");
            return;
        }

        int totalGeneralEntree = 0;
        String totalEntreeQuery = "SELECT SUM(quantite) - SUM(quantiteActuel) AS total FROM stockentrer WHERE id_produit = ?";
        PreparedStatement psTotal = connection.prepareStatement(totalEntreeQuery);
        psTotal.setInt(1, produitId);
        ResultSet rsTotal = psTotal.executeQuery();
        if (rsTotal.next()) {
            totalGeneralEntree = rsTotal.getInt("total");
        }

        String query = "SELECT YEAR(date_reception) AS annee, " +
                "SUM(quantite) AS stock_entre, " +
                "SUM(quantiteActuel) AS stock_actuel " +
                "FROM stockentrer " +
                "WHERE id_produit = ? " +
                "AND YEAR(date_reception) >= YEAR(CURDATE()) - 4 " +
                "GROUP BY YEAR(date_reception) " +
                "ORDER BY annee DESC";

        PreparedStatement ps = connection.prepareStatement(query);
        ps.setInt(1, produitId);
        ResultSet rs = ps.executeQuery();

        List<StatistiqueAnnee> statistiques = new ArrayList<>();

     
        System.out.println("╔══════╦══════════════╦════════════╦══════════════╦══════════════════════╗");
        System.out.println("║ Année║ Total Entrée ║Total reste ║Total Consommé║ Pourcentage Consommé ║");
        System.out.println("╠══════╬══════════════╬════════════╬══════════════╬══════════════════════╣");

        while (rs.next()) {
            int annee = rs.getInt("annee");
            int stockEntree = rs.getInt("stock_entre");
            int stockActuel = rs.getInt("stock_actuel");

            int totalConsomme = stockEntree - stockActuel;

            double pourcentage = totalGeneralEntree != 0 ? (totalConsomme * 100.0) / totalGeneralEntree : 0;
            

            String pourcentageStr = String.format("%.2f%%", pourcentage);
            System.out.printf("║ %-5d║ %-13d║ %-11d║ %-13d║ %-21s║\n", annee, stockEntree, stockActuel, totalConsomme, pourcentageStr);

            statistiques.add(new StatistiqueAnnee(annee, stockEntree, stockActuel, totalConsomme, pourcentage));
        }

        System.out.println("╚══════╩══════════════╩════════════╩══════════════╩══════════════════════╝");


        System.out.println("\n---------------------------------------------------------------");

        System.out.println("Statistiques de Consommation par Année pour le produit: " + nomProduit);
        System.out.println();

        for (StatistiqueAnnee statistique : statistiques) {
            String barreGraphique = creerBarreGraphique(statistique.pourcentage);
            System.out.printf("%4d | %6.2f%% | %-50s\n", statistique.annee, statistique.pourcentage, barreGraphique);
            System.out.println();
        }

        rs.close();
        ps.close();
        rsTotal.close();
        psTotal.close();
    }

    private String creerBarreGraphique(double pourcentage) {
        int longueurMax = 50;  // Taille maximale de la barre
        int longueurBarre = (int) (pourcentage / 100 * longueurMax);

        // Créer une barre avec des couleurs (si le terminal le supporte)
        StringBuilder barre = new StringBuilder();
        for (int i = 0; i < longueurBarre; i++) {
            barre.append("\u001B[42m "); // Fond vert pour la barre
        }
        for (int i = longueurBarre; i < longueurMax; i++) {
            barre.append("\u001B[47m "); // Fond gris pour l'espace vide
        }

        // Réinitialiser la couleur à la fin
        barre.append("\u001B[0m");

        return barre.toString();
    }

    // Classe pour représenter les données de chaque année
    private static class StatistiqueAnnee {
        int annee;
        int stockEntree;
        int stockActuel;
        int totalConsomme;
        double pourcentage;

        StatistiqueAnnee(int annee, int stockEntree, int stockActuel, int totalConsomme, double pourcentage) {
            this.annee = annee;
            this.stockEntree = stockEntree;
            this.stockActuel = stockActuel;
            this.totalConsomme = totalConsomme;
            this.pourcentage = pourcentage;
        }
    }

}
