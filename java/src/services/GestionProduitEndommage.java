package services;

import java.sql.*;
import java.time.LocalDate;
import java.util.ArrayList;
import java.util.List;
import java.util.Scanner;
import main.Database;

public interface GestionProduitEndommage {

    Scanner scanner = new Scanner(System.in);

   default void ajouterProduitEndommage(String typeProduit) {
    System.out.print(typeProduit);
    System.out.print("🔎 Entrez le nom du produit endommagé : ");
    String nomProduit = scanner.nextLine().trim();

    System.out.print("🔢 Quantité endommagée : ");
    int quantiteEndommagee = Integer.parseInt(scanner.nextLine());

    System.out.print("✏️ Description : ");
    String description = scanner.nextLine();

    LocalDate dateSignalement = LocalDate.now();

    String sqlRechercheStocks = """
        SELECT se.id_ST, se.quantiteActuel, p.id_produit
        FROM produit p
        JOIN stockEntrer se ON p.id_produit = se.id_produit
        WHERE p.nom = ? AND p.type = ? AND se.quantiteActuel > 0
        ORDER BY se.date_Reception ASC
    """;

    try (Connection conn = Database.getConnection();
         PreparedStatement stmt = conn.prepareStatement(sqlRechercheStocks)) {

        stmt.setString(1, nomProduit);
        stmt.setString(2, typeProduit);
        ResultSet rs = stmt.executeQuery();

        List<Integer> idSTList = new ArrayList<>();
        List<Integer> stockQuantites = new ArrayList<>();
        int idProduit = -1;
        int totalDispo = 0;

        while (rs.next()) {
            idSTList.add(rs.getInt("id_ST"));
            stockQuantites.add(rs.getInt("quantiteActuel"));
            totalDispo += rs.getInt("quantiteActuel");
            idProduit = rs.getInt("id_produit");
        }

        if (idSTList.isEmpty() || totalDispo < quantiteEndommagee) {
            System.out.println("❌ Pas assez de stock pour enregistrer cette quantité endommagée !");
            return;
        }

        conn.setAutoCommit(false);

        String sqlInsertPE = "INSERT INTO produit_endommage (id_ST, quantite, description, date_signalement) VALUES (?, ?, ?, ?)";
        String sqlUpdateStock = "UPDATE stockEntrer SET quantiteActuel = quantiteActuel - ? WHERE id_ST = ?";
        String sqlUpdateProduit = "UPDATE produit SET quantite = quantite - ? WHERE id_produit = ?";

        try (
            PreparedStatement stmtInsert = conn.prepareStatement(sqlInsertPE);
            PreparedStatement stmtStock = conn.prepareStatement(sqlUpdateStock);
            PreparedStatement stmtProduit = conn.prepareStatement(sqlUpdateProduit)
        ) {
            int reste = quantiteEndommagee;

            int i = 0;
            while (reste > 0 && i < idSTList.size()) {
            	
                int idST = idSTList.get(i);
                int disponible = stockQuantites.get(i);
                int aPrelever = Math.min(reste, disponible);

                stmtStock.setInt(1, aPrelever);
                stmtStock.setInt(2, idST);
                stmtStock.executeUpdate();

                stmtInsert.setInt(1, idST);
                stmtInsert.setInt(2, aPrelever);
                stmtInsert.setString(3, description);
                stmtInsert.setDate(4, Date.valueOf(dateSignalement));
                stmtInsert.executeUpdate();

                reste -= aPrelever;
                i++; 
            }


            stmtProduit.setInt(1, quantiteEndommagee);
            stmtProduit.setInt(2, idProduit);
            stmtProduit.executeUpdate();

            conn.commit();
            System.out.println("✅ Produit endommagé enregistré sur plusieurs stocks, quantités mises à jour !");
        } catch (SQLException e) {
            conn.rollback();
            System.out.println("❌ Erreur pendant l’opération : " + e.getMessage());
        }

    } catch (SQLException e) {
        System.out.println("❌ Erreur de connexion : " + e.getMessage());
    }
}

   default void afficherProduitsEndommagesParNom() {
	    System.out.print("🔎 Entrez le nom du produit : ");
	    String nomProduit = scanner.nextLine().trim();

	    String sql = "SELECT p.nom, p.type, pe.quantite, pe.date_signalement, pe.description " +
	                 "FROM produit_endommage pe " +
	                 "JOIN stockEntrer se ON pe.id_ST = se.id_ST " +
	                 "JOIN produit p ON se.id_produit = p.id_produit " +
	                 "WHERE p.nom = ? " +
	                 "ORDER BY pe.date_signalement DESC";

	    try (Connection conn = Database.getConnection();
	         PreparedStatement stmt = conn.prepareStatement(sql)) {

	        stmt.setString(1, nomProduit);
	        ResultSet rs = stmt.executeQuery();

	        System.out.println("\n📦 PRODUITS ENDOMMAGÉS POUR : " + nomProduit.toUpperCase());
	        System.out.println("╔════════════════════╦════════════╦════════════╦════════════════════╦════════════════════════════════╗");
	        System.out.println("║ Nom du produit     ║ Type       ║ Quantité   ║ Date signalement   ║ Description                    ║");
	        System.out.println("╠════════════════════╬════════════╬════════════╬════════════════════╬════════════════════════════════╣");

	        boolean found = false;
	        while (rs.next()) {
	            found = true;
	            String nom = rs.getString("nom");
	            String type = rs.getString("type");
	            int quantite = rs.getInt("quantite");
	            Date date = rs.getDate("date_signalement");
	            String description = rs.getString("description");

	            System.out.printf("║ %-18s ║ %-10s ║ %-10d ║ %-18s ║ %-30s ║%n",
	                              nom, type, quantite, date.toString(), description);
	        }

	        if (!found) {
	            System.out.println("║      Aucun produit endommagé trouvé pour ce nom.                ║");
	        }

	        System.out.println("╚════════════════════╩════════════╩════════════╩════════════════════╩════════════════════════════════╝");

	    } catch (SQLException e) {
	        System.out.println("❌ Erreur lors de l'affichage : " + e.getMessage());
	    }
	}

}
