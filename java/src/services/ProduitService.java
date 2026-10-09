package services;

import models.MaterielCuisine;
import models.PieceMecanique;
import models.Produit;
import models.ProduitAlimentaire;
import java.sql.*;
import java.time.LocalDate;
import java.util.Scanner;
import main.Database;

public class ProduitService {
	
	//lister les produits
	public void afficherProduits() {
		    String sql = """
		        SELECT p.*, c.categorie, u.unite 
		        FROM produit p 
		        INNER JOIN categorie c ON p.id_categorie = c.id_categorie
		        INNER JOIN unite u ON p.id_unite = u.id_unite
		        ORDER BY p.type, p.nom
		    """;

		    String currentType = "";
		    boolean first = true;

		    try (Connection conn = Database.getConnection();
		         Statement stmt = conn.createStatement();
		         ResultSet rs = stmt.executeQuery(sql)) {

		        if (!rs.isBeforeFirst()) {
		            System.out.println("Aucun produit trouvé.");
		            return;
		        }

		        while (rs.next()) {
		            String type = rs.getString("type");

		            if (!type.equals(currentType)) {
		                if (!first) {
		                    switch (currentType) {
		                        case "alimentaire", "mecanique" ->
		                            System.out.println("╚════════════════════╩══════╩════════╩══════════╩════════════════════╩════════════════════╝");
		                        case "cuisine" ->
		                            System.out.println("╚════════════════════╩══════╩════════╩══════════╩════════════════════╝");
		                    }
		                    System.out.println(); // Ligne vide entre les groupes
		                }

		                currentType = type;
		                first = false;

		                switch (type) {
		                    case "alimentaire" -> {
		                        System.out.println("📦 Produits Alimentaires :");
		                        System.out.println("╔════════════════════╦══════╦════════╦══════════╦════════════════════╦════════════════════╗");
		                        System.out.println("║ Nom                ║ Qté  ║ Unité  ║ Prix(DH) ║ Date Expiration    ║ Catégorie          ║");
		                        System.out.println("╠════════════════════╬══════╬════════╬══════════╬════════════════════╬════════════════════╣");
		                    }
		                    case "mecanique" -> {
		                        System.out.println("🔧 Pièces Mécaniques :");
		                        System.out.println("╔════════════════════╦══════╦════════╦══════════╦════════════════════╦════════════════════╗");
		                        System.out.println("║ Nom                ║ Qté  ║ Unité  ║ Prix(DH) ║ Référence          ║ Catégorie          ║");
		                        System.out.println("╠════════════════════╬══════╬════════╬══════════╬════════════════════╬════════════════════╣");
		                    }
		                    case "cuisine" -> {
		                        System.out.println("🍽️ Matériel de Cuisine :");
		                        System.out.println("╔════════════════════╦══════╦════════╦══════════╦════════════════════╗");
		                        System.out.println("║ Nom                ║ Qté  ║ Unité  ║ Prix(DH) ║ Catégorie          ║");
		                        System.out.println("╠════════════════════╬══════╬════════╬══════════╬════════════════════╣");
		                    }
		                    default -> System.out.println("❓ Type inconnu :");
		                }
		            }

		            // Données produit
		            int id_produit = rs.getInt("id_produit");
		            String nom = rs.getString("nom");
		            int quantite = rs.getInt("quantite");
		            String unite = rs.getString("unite");
		            double prixUnitaire = rs.getDouble("prix_unitaire");
		            String reference = rs.getString("reference");
		            int idCategorie = rs.getInt("id_categorie");
		            Date sqlDate = rs.getDate("date_expiration"); 
		            LocalDate dateExpiration = (sqlDate != null) ? sqlDate.toLocalDate() : null;
		            int idUnite = rs.getInt("id_unite");
		            String categorie = rs.getString("categorie");

		            Produit produit = switch (type) {
		                case "alimentaire" -> new ProduitAlimentaire(id_produit,nom, quantite, idUnite, prixUnitaire, idCategorie,dateExpiration);
		                case "mecanique" -> new PieceMecanique(id_produit,nom, quantite, idUnite, prixUnitaire, idCategorie, reference);
		                case "cuisine" -> new MaterielCuisine(id_produit,nom, quantite, idUnite, prixUnitaire, idCategorie);
		                default -> null;
		            };

		            if (produit != null) {
		                produit.afficherDetails(categorie,unite);
		            }
		        }
		        switch (currentType) {
		        case "alimentaire", "mecanique" ->
		            System.out.println("╚════════════════════╩══════╩════════╩══════════╩════════════════════╩════════════════════╝");
		        case "cuisine" ->
		            System.out.println("╚════════════════════╩══════╩════════╩══════════╩════════════════════╝");
		        }

		    } catch (SQLException e) {
		        System.out.println("Erreur lors de l'affichage des produits : " + e.getMessage());
		    }
		}
		
    // Create a new product
	public void ajouterProduit(Produit produit) {
	    String sql = "INSERT INTO produit (nom, quantite, id_unite, prix_unitaire, reference, date_expiration, type, id_categorie) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

	    try (Connection conn = Database.getConnection();
	         PreparedStatement stmt = conn.prepareStatement(sql)) {

	        stmt.setString(1, produit.getNom());
	        stmt.setInt(2, produit.getQuantite());
	        stmt.setInt(3, produit.getId_Unite());
	        stmt.setDouble(4, produit.getPrixUnitaire());

	        // Reference pour PieceMecanique
	        if (produit instanceof PieceMecanique) {
	            stmt.setString(5, ((PieceMecanique) produit).getReference());
	        } else {
	            stmt.setNull(5, Types.VARCHAR);
	        }

	        
	        stmt.setNull(6, Types.DATE);
	        stmt.setString(7, produit.getType());
	        stmt.setInt(8, produit.getId_categorie());

	        stmt.executeUpdate();
	        System.out.println("✅ Produit ajouté avec succès !");
	    } catch (SQLIntegrityConstraintViolationException e) {
	        System.out.println("❌ Erreur : le produit existe déjà !");
	    } catch (SQLException e) {
	        System.out.println("❌ Erreur d'ajout du produit : " + e.getMessage());
	    }
	} 
	
	//chercher un produit
	public Produit rechercherProduitParNom() {
	    Scanner scanner = new Scanner(System.in);

	    int choix = -1;
	    while (choix < 1 || choix > 3) {
	        try {
	            System.out.println("🧩 Choisissez le type de produit à rechercher :");
	            System.out.println("1. Produit Alimentaire");
	            System.out.println("2. Pièce Mécanique");
	            System.out.println("3. Matériel de Cuisine");
	            System.out.print("👉 Votre choix : ");
	            choix = Integer.parseInt(scanner.nextLine());

	            if (choix < 1 || choix > 3) {
	                System.out.println("❌ Choix invalide, veuillez entrer un nombre entre 1 et 3.");
	            }
	        } catch (NumberFormatException e) {
	            System.out.println("❌ Entrée invalide, veuillez entrer un nombre valide.");
	        }
	    }

	    String type;
	    switch (choix) {
	        case 1 -> type = "alimentaire";
	        case 2 -> type = "mecanique";
	        case 3 -> type = "cuisine";
	        default -> { 
	            System.out.println("❌ Type invalide !");
	            return null;
	        }
	    }


	    // Demander à l'utilisateur de saisir le nom du produit
	    System.out.print("🔍 Entrez le nom du produit à rechercher : ");
	    String nom = scanner.nextLine();

	    // Recherche du produit dans la base de données
	    String sql = """
	        SELECT p.*, c.categorie, u.unite 
	        FROM produit p 
	        JOIN categorie c ON p.id_categorie = c.id_categorie 
	        JOIN unite u ON p.id_unite = u.id_unite 
	        WHERE p.nom = ? AND p.type = ?;
	    """;

	    try (Connection conn = Database.getConnection();
	         PreparedStatement stmt = conn.prepareStatement(sql)) {

	        stmt.setString(1, nom);
	        stmt.setString(2, type);

	        ResultSet rs = stmt.executeQuery();

	        if (rs.next()) {
	            // Récupérer les informations du produit
	        	int id_produit = rs.getInt("id_produit");
	            int quantite = rs.getInt("quantite");
	            int idUnite = rs.getInt("id_unite");
	            double prixUnitaire = rs.getDouble("prix_unitaire");
	            String reference = rs.getString("reference");
	            Date dateExpiration = rs.getDate("date_expiration");
	            int idCategorie = rs.getInt("id_categorie");
	            String categorie = rs.getString("categorie");
	            String unite = rs.getString("unite");

	            // Créer le produit selon son type
	            Produit produit = switch (type) {
	                case "alimentaire" -> new ProduitAlimentaire(id_produit,nom, quantite, idUnite, prixUnitaire, idCategorie,
	                        dateExpiration != null ? dateExpiration.toLocalDate() : null);
	                case "mecanique" -> new PieceMecanique(id_produit,nom, quantite, idUnite, prixUnitaire, idCategorie, reference);
	                case "cuisine" -> new MaterielCuisine(id_produit,nom, quantite, idUnite, prixUnitaire, idCategorie);
	                default -> null;
	            };

	            // Afficher les détails du produit
	            if (produit != null) {
	                afficherDetailsProduit(type, produit, categorie, unite);
	            }

	            return produit;
	        } else {
	            System.out.println("❌ Aucun produit trouvé avec le nom : " + nom + " et le type : " + type);
	            return null;
	        }

	    } catch (SQLException e) {
	        System.out.println("Erreur lors de la recherche : " + e.getMessage());
	        return null;
	    }
	}
	
	//afficher un produit 
	private void afficherDetailsProduit(String type, Produit produit, String categorie, String unite) {
	    // Affichage des informations du produit
		 switch (type) {
         case "alimentaire" -> {
             System.out.println("📦 Produits Alimentaires :");
             System.out.println("╔════════════════════╦══════╦════════╦══════════╦════════════════════╦════════════════════╗");
             System.out.println("║ Nom                ║ Qté  ║ Unité  ║ Prix(DH) ║ Date Expiration    ║ Catégorie          ║");
             System.out.println("╠════════════════════╬══════╬════════╬══════════╬════════════════════╬════════════════════╣");
         }
         case "mecanique" -> {
             System.out.println("🔧 Pièces Mécaniques :");
             System.out.println("╔════════════════════╦══════╦════════╦══════════╦════════════════════╦════════════════════╗");
             System.out.println("║ Nom                ║ Qté  ║ Unité  ║ Prix(DH) ║ Référence          ║ Catégorie          ║");
             System.out.println("╠════════════════════╬══════╬════════╬══════════╬════════════════════╬════════════════════╣");
         }
         case "cuisine" -> {
             System.out.println("🍽️ Matériel de Cuisine :");
             System.out.println("╔════════════════════╦══════╦════════╦══════════╦════════════════════╗");
             System.out.println("║ Nom                ║ Qté  ║ Unité  ║ Prix(DH) ║ Catégorie          ║");
             System.out.println("╠════════════════════╬══════╬════════╬══════════╬════════════════════╣");
         }
         default -> System.out.println("❓ Type inconnu :");
     }
		 produit.afficherDetails(categorie, unite);
		 switch (type) {
	        case "alimentaire", "mecanique" ->
	            System.out.println("╚════════════════════╩══════╩════════╩══════════╩════════════════════╩════════════════════╝");
	        case "cuisine" ->
	            System.out.println("╚════════════════════╩══════╩════════╩══════════╩════════════════════╝");
	    }	   
	}
	
	
	public String getCategorieById(int idCategorie) {
		
	    String sql = "SELECT categorie FROM categorie WHERE id_categorie = ?";
	    try (Connection conn = Database.getConnection();
	         PreparedStatement stmt = conn.prepareStatement(sql)) {

	        stmt.setInt(1, idCategorie);
	        ResultSet rs = stmt.executeQuery();

	        if (rs.next()) {
	            return rs.getString("categorie");  // Récupérer le nom de la catégorie
	        } else {
	            System.out.println("❌ Catégorie non trouvée pour l'ID : " + idCategorie);
	            return "Inconnue"; 
	        }

	    } catch (SQLException e) {
	        System.out.println("Erreur lors de la récupération de la catégorie : " + e.getMessage());
	        return "Erreur";
	    }
	}

      //Modifier le produit apres recherche
	public void modifierProduitParNom() {
	    Scanner scanner = new Scanner(System.in);

	    // Recherche du produit par nom
	    Produit ancienProduit = rechercherProduitParNom();
	    if (ancienProduit == null) {
	        System.out.println("❌ Produit non trouvé !");
	        return;
	    }

	    System.out.println("\n--- 🛠 Modifier les champs du produit ---");

	    // Demander un nouveau nom
	    System.out.print("Nouveau nom [" + ancienProduit.getNom() + "] : ");
	    String nom = scanner.nextLine();
	    if (nom.isEmpty()) {
	        nom = ancienProduit.getNom();  // Conserver l'ancien nom si l'utilisateur ne modifie pas
	    }

	    // Afficher les unités disponibles
	    categorie_unite uniteService = new categorie_unite();
	    uniteService.afficherListe("unite");

	    // Validation de l'ID Unité
	    int idUnite = ancienProduit.getId_Unite();  // Valeur par défaut
	    boolean valideUnite = false;
	    while (!valideUnite) {
	        System.out.print("Nouvelle unité [" + idUnite + "] : ");
	        String inputUnite = scanner.nextLine();
	        if (inputUnite.isEmpty()) {
	            idUnite = ancienProduit.getId_Unite();  // Conserver l'ancien ID si non modifié
	            valideUnite = true;
	        } else {
	            try {
	                idUnite = Integer.parseInt(inputUnite);
	                valideUnite = true;  // L'ID de l'unité est valide
	            } catch (NumberFormatException e) {
	                System.out.println("❌ L'ID de l'unité doit être un entier valide.");
	            }
	        }
	    }

	    // Afficher les catégories disponibles
	    categorie_unite categorieService = new categorie_unite();
	    categorieService.afficherListe("categorie");

	    // Validation de l'ID Catégorie
	    int idCategorie = ancienProduit.getId_categorie();  // Valeur par défaut
	    boolean valideCategorie = false;
	    while (!valideCategorie) {
	        System.out.print("Nouvel ID catégorie [" + idCategorie + "] : ");
	        String inputCat = scanner.nextLine();
	        if (inputCat.isEmpty()) {
	            idCategorie = ancienProduit.getId_categorie();  // Conserver l'ancien ID si non modifié
	            valideCategorie = true;
	        } else {
	            try {
	                idCategorie = Integer.parseInt(inputCat);
	                valideCategorie = true;  // L'ID de la catégorie est valide
	            } catch (NumberFormatException e) {
	                System.out.println("❌ L'ID de la catégorie doit être un entier valide.");
	            }
	        }
	    }

	    // Créer le nouveau produit en fonction de son type
	    Produit nouveauProduit = null;
	    if (ancienProduit instanceof ProduitAlimentaire pa) {
	        nouveauProduit = new ProduitAlimentaire(ancienProduit.getIdProduit(), nom, 0, idUnite, 0, idCategorie, null);
	    } else if (ancienProduit instanceof PieceMecanique pm) {
	        System.out.print("Nouvelle référence [" + pm.getReference() + "] : ");
	        String reference = scanner.nextLine();
	        if (reference.isEmpty()) {
	            reference = pm.getReference();  // Conserver l'ancienne référence si non modifiée
	        }
	        nouveauProduit = new PieceMecanique(ancienProduit.getIdProduit(), nom, 0, idUnite, 0, idCategorie, reference);
	    } else if (ancienProduit instanceof MaterielCuisine) {
	        nouveauProduit = new MaterielCuisine(ancienProduit.getIdProduit(), nom, 0, idUnite, 0, idCategorie);
	    }

	    // Appliquer les modifications si le produit a bien été créé
	    if (nouveauProduit != null) {
	        ProduitService service = new ProduitService();
	        service.modifierProduit(nouveauProduit);
	        System.out.println("✅ Produit modifié avec succès !");
	    } else {
	        System.out.println("❌ Erreur : Type de produit non pris en charge pour modification.");
	    }
	}

    // Update a product
	
    public void modifierProduit(Produit produit) {
        String sql = "UPDATE produit SET nom = ?, quantite = ?, id_unite = ?, prix_unitaire = ?, reference = ?, date_expiration = ?, type = ?, id_categorie = ? WHERE id_produit = ?";

        try (Connection conn = Database.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {

            stmt.setString(1, produit.getNom());
            stmt.setInt(2, produit.getQuantite());
            stmt.setInt(3, produit.getId_Unite());
            stmt.setDouble(4, produit.getPrixUnitaire());

            // Handle the reference for PieceMecanique only
            if (produit instanceof PieceMecanique) {
                stmt.setString(5, ((PieceMecanique) produit).getReference());
            } else {
                stmt.setString(5, null);  // Null for other product types
            }

            stmt.setNull(6, Types.DATE);            
            stmt.setString(7, produit.getType());
            stmt.setInt(8, produit.getId_categorie());
            stmt.setInt(9, produit.getIdProduit());

            stmt.executeUpdate();
            System.out.println("Produit modifié avec succès !");
        } catch (SQLException e) {
            System.out.println("Erreur lors de la modification du produit : " + e.getMessage());
        }
    }

    // Delete a product
    public void supprimerProduitParNom() {
    	
        Scanner scanner = new Scanner(System.in);
        
        System.out.print("Entrez le nom du produit à supprimer : ");
        String nom = scanner.nextLine();

        String sqlCheck = "SELECT 1 FROM produit WHERE nom = ?";
        String sqlDelete = "DELETE FROM produit WHERE nom = ?";

        try (Connection conn = Database.getConnection();
             PreparedStatement checkStmt = conn.prepareStatement(sqlCheck)) {

            checkStmt.setString(1, nom);
            ResultSet rs = checkStmt.executeQuery();

            if (rs.next()) {
                try (PreparedStatement deleteStmt = conn.prepareStatement(sqlDelete)) {
                    deleteStmt.setString(1, nom);
                    int rows = deleteStmt.executeUpdate();

                    if (rows > 0) {
                        System.out.println("✅ Produit supprimé avec succès !");
                    } else {
                        System.out.println("❌ Échec de la suppression.");
                    }
                }
            } else {
                System.out.println("❌ Aucun produit trouvé avec le nom : " + nom);
            }

        } catch (SQLException e) {
            System.out.println("Erreur lors de la suppression du produit : " + e.getMessage());
        }
    }


    public void afficherProduitsPresqueTerminés() {
    	
    	Scanner scanner = new Scanner(System.in);
    	System.out.println("📦 Choisissez le type de produit à afficher :");
    	System.out.println("1. Alimentaire");
    	System.out.println("2. Mécanique");
    	System.out.println("3. Cuisine");
    	System.out.print("Votre choix : ");
    	String choix = scanner.nextLine().trim();

    	String typeProduit = null;

    	switch (choix) {
    	    case "1" -> typeProduit = "alimentaire";
    	    case "2" -> typeProduit = "mecanique";
    	    case "3" -> typeProduit = "cuisine";
    	    default -> {
    	        System.out.println("❌ Type invalide.");
    	        return;
    	    }
    	}

        int seuil = 20;

        String sql = """
            SELECT 
                p.nom, 
                p.quantite, 
                p.prix_unitaire,
                p.reference, 
                p.date_expiration,
                c.categorie,
                u.unite
            FROM produit p
            INNER JOIN categorie c ON p.id_categorie = c.id_categorie
            INNER JOIN unite u ON p.id_unite = u.id_unite
            WHERE p.type = ? AND p.quantite <= ?
            ORDER BY p.quantite ASC
        """;

        try (Connection conn = Database.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {

            stmt.setString(1, typeProduit);
            stmt.setInt(2, seuil);
            ResultSet rs = stmt.executeQuery();

            System.out.println("\n📦 Produits '" + typeProduit + "' presque terminés");
            System.out.println("╔════════════════════╦══════════╦════════════════╦════════════╦══════════════╦════════════════════╦════════════════════╗");
            System.out.println("║ Nom                ║ Quantité ║ Prix Unitaire  ║ Unité      ║ Référence    ║ Date Expiration    ║ Catégorie          ║");
            System.out.println("╠════════════════════╬══════════╬════════════════╬════════════╬══════════════╬════════════════════╬════════════════════╣");

            boolean found = false;
            while (rs.next()) {
                found = true;
                String nom = rs.getString("nom");
                int quantite = rs.getInt("quantite");
                double prixUnitaire = rs.getDouble("prix_unitaire");
                String reference = rs.getString("reference");
                Date dateExp = rs.getDate("date_expiration");
                String categorie = rs.getString("categorie");
                String unite = rs.getString("unite");

                System.out.printf("║ %-18s ║ %-8d ║ %-14.2f ║ %-10s ║ %-12s ║ %-18s ║ %-18s ║\n",
                        nom,
                        quantite,
                        prixUnitaire,
                        unite,
                        reference != null ? reference : "-",
                        dateExp != null ? dateExp.toString() : "-",
                        categorie);
            }

            System.out.println("╚════════════════════╩══════════╩════════════════╩════════════╩══════════════╩════════════════════╩════════════════════╝");


            if (!found) {
                System.out.println("✅ Aucun produit de type '" + typeProduit + "' proche de rupture.");
            }

        } catch (SQLException e) {
            System.out.println("❌ Erreur SQL : " + e.getMessage());
            e.printStackTrace();
        }
    }
    
    
    public void afficherStatistiquesConsommation() {
        Scanner scanner = new Scanner(System.in);

     // Saisie du type de produit sous forme de numéro
        System.out.println("Choisissez le type de produit :");
        System.out.println("1. Alimentaire");
        System.out.println("2. Mécanique");
        System.out.println("3. Cuisine");
        System.out.print("Entrez le numéro du type de produit : ");
        String choixTypeProduit = scanner.nextLine();
        scanner.nextLine();  

        String typeProduit = "";

        switch (choixTypeProduit) {
            case "1":
                typeProduit = "alimentaire";
                break;
            case "2":
                typeProduit = "mécanique";
                break;
            case "3":
                typeProduit = "cuisine";
                break;
            default:
                System.out.println("❌ Choix invalide ! Veuillez entrer un numéro valide (1, 2, ou 3).");
                return; 
        }

        categorie_unite categorieService = new categorie_unite();
	    categorieService.afficherListe("categorie");
        
        System.out.print("Entrez le nom de la catégorie du produit (ex. Boisson, Snack, etc.) : ");
        String categorieProduit = scanner.nextLine();

        String sql = """
            SELECT p.nom,
                   SUM(se.quantite) AS total_quantite,
                   SUM(se.quantiteActuel) AS total_quantite_actuelle
            FROM produit p
            JOIN stockentrer se ON p.id_produit = se.id_produit
            JOIN categorie c ON p.id_categorie = c.id_categorie
            WHERE p.type = ? 
              AND c.categorie = ?
              AND YEAR(se.date_reception) = YEAR(CURDATE())
            GROUP BY p.nom ORDER BY total_quantite DESC;
        """;

        try (Connection conn = Database.getConnection();
        	     PreparedStatement stmt = conn.prepareStatement(sql)) {

        	    stmt.setString(1, typeProduit);
        	    stmt.setString(2, categorieProduit);

        	    ResultSet rs = stmt.executeQuery();

        	    System.out.println("╔════════════════════╦════════════════╦═══════════════════╦════════════════╗");
        	    System.out.println("║ Produit            ║ % Consommation ║ Qté Entrée Totale ║ Qté Sortie     ║");
        	    System.out.println("╠════════════════════╬════════════════╬═══════════════════╬════════════════╣");

        	    boolean hasResult = false; // On crée un indicateur pour savoir si on a des résultats

        	    while (rs.next()) {
        	        hasResult = true; // Dès qu'on trouve un premier résultat, on le met à true

        	        String nomProduit = rs.getString("nom");
        	        int totalQuantite = rs.getInt("total_quantite");
        	        int totalQuantiteActuelle = rs.getInt("total_quantite_actuelle");

        	        int quantiteSortie = totalQuantite - totalQuantiteActuelle;
        	        int pourcentage = (int) ((totalQuantite > 0)
        	            ? ((double) quantiteSortie / totalQuantite) * 100
        	            : 0);

        	        System.out.printf("║ %-18s ║ %-14s ║ %-17d ║ %-14d ║\n",
        	                nomProduit, pourcentage + " %", totalQuantite, quantiteSortie);
        	    }

        	    if (!hasResult) {
        	        System.out.printf("║ %-72s ║\n", "          Aucun produit trouvé pour ce type et cette catégorie.");
        	    }

        	    System.out.println("╚════════════════════╩════════════════╩═══════════════════╩════════════════╝");

        	} catch (SQLException e) {
        	    System.out.println("Erreur lors de l'affichage des statistiques : " + e.getMessage());
        	}

    }

}
