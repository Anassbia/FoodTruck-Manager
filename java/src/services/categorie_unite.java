package services;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.Scanner;

import main.Database;

public class categorie_unite {
	
	Scanner scanner = new Scanner(System.in);

    public void CRUD(String table, String action) {
    	
    	String valeur;
    	do {
    	    System.out.print("Nom à " + (action.equalsIgnoreCase("add") ? "ajouter" : "vous voulez " + action) + " : ");
    	    valeur = scanner.nextLine().trim();

    	    if (valeur.isEmpty()) {
    	        System.out.println("❌ Le nom ne peut pas être vide. Veuillez réessayer.");
    	    }
    	} while (valeur.isEmpty());


        String sqlExist = "SELECT 1 FROM " + table + " WHERE LOWER(" + table + ") = LOWER(?)";

        try (Connection conn = Database.getConnection();
             PreparedStatement checkStmt = conn.prepareStatement(sqlExist)) {

            checkStmt.setString(1, valeur);
            ResultSet rs = checkStmt.executeQuery();

            boolean existe = rs.next();

            if (action.equalsIgnoreCase("add")) {
                if (existe) {
                    System.out.println("⚠️ La valeur \"" + valeur + "\" existe déjà dans " + table + ".");
                } else {
                    String sqlInsert = "INSERT INTO " + table + " (" + table + ") VALUES (?)";
                    try (PreparedStatement insertStmt = conn.prepareStatement(sqlInsert)) {
                        insertStmt.setString(1, valeur);
                        int rows = insertStmt.executeUpdate();
                        if (rows > 0) {
                            System.out.println("✅ Ajout réussi !");
                        } else {
                            System.out.println("❌ Échec de l’ajout.");
                        }
                    }
                }
            } else if (action.equalsIgnoreCase("delete")) {
                if (!existe) {
                    System.out.println("❌ La valeur \"" + valeur + "\" n'existe pas dans " + table + ".");
                } else {
                    String sqlDelete = "DELETE FROM " + table + " WHERE LOWER(" + table + ") = LOWER(?)";
                    try (PreparedStatement deleteStmt = conn.prepareStatement(sqlDelete)) {
                        deleteStmt.setString(1, valeur);
                        int rows = deleteStmt.executeUpdate();
                        if (rows > 0) {
                            System.out.println("✅ Suppression réussie !");
                        } else {
                            System.out.println("❌ Échec de la suppression.");
                        }
                    } catch (SQLException e) {
                        if (e.getMessage().contains("a foreign key constraint fails")) {
                            System.out.println("❌ Impossible de supprimer : cette valeur est utilisée dans un produit.");
                        } else {
                            System.out.println("Erreur lors de l’opération : " + e.getMessage());
                        }
                    }
                }
            } else if (action.equalsIgnoreCase("update")) {
                if (!existe) {
                    System.out.println("❌ La valeur \"" + valeur + "\" n'existe pas dans " + table + ".");
                } else {
                	String nouvelleValeur;
                	do {
                	    System.out.print("Nouvelle valeur pour " + table + " : ");
                	    nouvelleValeur = scanner.nextLine().trim();

                	    if (nouvelleValeur.isEmpty()) {
                	        System.out.println("❌ La valeur ne peut pas être vide. Veuillez réessayer.");
                	    }
                	} while (nouvelleValeur.isEmpty());


                    String sqlUpdate = "UPDATE " + table + " SET " + table + " = ? WHERE LOWER(" + table + ") = LOWER(?)";
                    try (PreparedStatement updateStmt = conn.prepareStatement(sqlUpdate)) {
                        updateStmt.setString(1, nouvelleValeur);
                        updateStmt.setString(2, valeur);
                        int rows = updateStmt.executeUpdate();
                        if (rows > 0) {
                            System.out.println("✅ Mise à jour réussie !");
                        } else {
                            System.out.println("❌ Échec de la mise à jour.");
                        }
                    } catch (SQLException e) {
                        System.out.println("Erreur lors de la mise à jour : " + e.getMessage());
                    }
                }
            } else {
                System.out.println("❌ Action inconnue : " + action);
            }

        } catch (SQLException e) {
            System.out.println("Erreur pendant l'opération '" + action + "' sur " + table + " : " + e.getMessage());
        }
    }
    
    public void afficherListe(String table) {
        String idColumn = "id_" + table;    
        String nomColumn = table;             
        String sql = "SELECT * FROM " + table;

        try (Connection conn = Database.getConnection();
             Statement stmt = conn.createStatement();
             ResultSet rs = stmt.executeQuery(sql)) {

            System.out.println("📋 Liste des " + table + "s disponibles :");
            while (rs.next()) {
                int id = rs.getInt(idColumn);
                String nom = rs.getString(nomColumn);
                System.out.println("  ➤ Numéro: " + id + " | Nom: " + nom);
            }

        } catch (SQLException e) {
            System.out.println("Erreur lors de la récupération des données pour " + table + " : " + e.getMessage());
        }
    }
 
    public boolean idExiste(String table, int id) {
        String sql = "SELECT COUNT(*) FROM " + table + " WHERE id_" + table + " = ?";
        
        try (Connection conn = Database.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {

            stmt.setInt(1, id);
            ResultSet rs = stmt.executeQuery();
            if (rs.next()) {
                return rs.getInt(1) > 0;
            }
        } catch (SQLException e) {
            System.out.println("❌ Erreur lors de la vérification : " + e.getMessage());
        }
        return false;
    }
 
}
