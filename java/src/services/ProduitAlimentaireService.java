package services;

import java.sql.Connection;
import java.sql.Date;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.time.LocalDate;
import java.util.Scanner;

import main.Database;
import models.ProduitAlimentaire;

public class ProduitAlimentaireService extends ProduitService {

	public void ajouterProduitAlimentaire() {
	    ProduitAlimentaire produit = new ProduitAlimentaire();
	    super.ajouterProduit(produit);  
	}
	
	public void afficherPerteProduitAlimentaire() {
		    Scanner scanner = new Scanner(System.in);
		    int annee = -1;
		    do {
		        System.out.print("📅 Entrez l'année à filtrer (ex: 2024) : ");
		        if (scanner.hasNextInt()) {
		            annee = scanner.nextInt();
		            break; 
		        } else {
		            System.out.println("❌ Entrée invalide, veuillez entrer un nombre !");
		            scanner.next(); 
		        }
		    } while (true);

		    scanner.nextLine();


		    String sql = """
		        SELECT 
		            p.nom, 
		            SUM(se.quantiteActuel) AS totalQuantite,
		            SUM(se.quantiteActuel * (se.prix /se.quantite)) AS totalMontant
		        FROM produit p
		        JOIN stockEntrer se ON p.id_produit = se.id_produit
		        WHERE p.type = 'alimentaire'
		          AND se.dateExpiration IS NOT NULL
		          AND YEAR(se.dateExpiration) = ?
		          AND se.dateExpiration < CURRENT_DATE
		          AND se.quantiteActuel > 0
		        GROUP BY p.nom
		    """;

		    try (Connection conn = Database.getConnection();
		         PreparedStatement stmt = conn.prepareStatement(sql)) {

		        stmt.setInt(1, annee);
		        try (ResultSet rs = stmt.executeQuery()) {

		            System.out.println("\n📦 Produits alimentaires expirés en " + annee + " :");
		            System.out.println("╔════════════════════════╦════════════════════╦════════════════════╗");
		            System.out.println("║ Produit                ║ Quantité Perdue    ║ Montant Perdu (DH) ║");
		            System.out.println("╠════════════════════════╬════════════════════╬════════════════════╣");

		            double totalMontantGlobal = 0;
		            boolean hasData = false;

		            while (rs.next()) {
		                hasData = true;
		                String nom = rs.getString("nom");
		                int totalQuantite = rs.getInt("totalQuantite");
		                double montantPerdu = rs.getDouble("totalMontant");

		                totalMontantGlobal += montantPerdu;

		                System.out.printf("║ %-22s ║ %-18d ║ %-18.2f ║\n", nom, totalQuantite, montantPerdu);
		            }

		            if (!hasData) {
		                System.out.println("║               Aucun produit expiré pour cette année.             ║");
		            }

		            System.out.println("╚════════════════════════╩════════════════════╩════════════════════╝");
		            System.out.printf("💸 Total des pertes pour %d : %.2f DH\n", annee, totalMontantGlobal);
		        }

		    } catch (SQLException e) {
		        System.out.println("❌ Erreur SQL : " + e.getMessage());
		        e.printStackTrace();
		    }
		}

    
}

