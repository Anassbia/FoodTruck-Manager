package main;

import services.*;

import java.sql.SQLException;
import java.util.Scanner;

public class Main {
    public static void main(String[] args) throws SQLException {
        Scanner scanner = new Scanner(System.in);
        ProduitService produitService = new ProduitService();
        categorie_unite uniteService = new categorie_unite();
        categorie_unite categorieService = new categorie_unite();

        while (true) {
            System.out.println("\n========= MENU PRINCIPAL =========");
            System.out.println("1. Gérer les produits");
            System.out.println("2. Gérer les unités");
            System.out.println("3. Gérer les catégories");
            System.out.println("4. Gérer les mouvements de stock");
            System.out.println("5. Statistiques");
            System.out.println("0. Quitter");
            System.out.print("Votre choix : ");
            String choix = scanner.nextLine();

            switch (choix) {
                case "1" -> {
                    System.out.println("\n-- Gérer les produits --");
                    System.out.println("1. Ajouter un produit");
                    System.out.println("2. Modifier un produit");
                    System.out.println("3. Supprimer un produit");
                    System.out.println("4. Afficher les produits");
                    System.out.println("5. Chercher un produit");
                    System.out.println("6. Les produits presque Terminer ");
                    System.out.print("Choix : ");
                    String prodChoix = scanner.nextLine();

                    switch (prodChoix) {
                        case "1" -> {
                            System.out.println("\n-- Choisir le type de produit à ajouter --");
                            System.out.println("1. Produit Alimentaire");
                            System.out.println("2. Pièce Mécanique");
                            System.out.println("3. Matériel de Cuisine");
                            System.out.print("Type : ");
                            String  typeProduit = scanner.nextLine();

                            switch (typeProduit) {
                                case "1" -> new ProduitAlimentaireService().ajouterProduitAlimentaire();
                                case "2" -> new PieceMecaniqueService().ajouterPieceMecanique();
                                case "3" -> new MaterielCuisineService().ajouterMaterielCuisine();
                                default -> System.out.println("❌ Type de produit invalide !");
                            }
                        }
                        case "2" -> produitService.modifierProduitParNom();
                        case "3" -> produitService.supprimerProduitParNom();
                        case "4" -> produitService.afficherProduits();
                        case "5" -> produitService.rechercherProduitParNom();
                        case "6" -> produitService.afficherProduitsPresqueTerminés();
                        default -> System.out.println("❌ Choix invalide.");
                    }
                }

                case "2" -> {
                    System.out.println("\n-- Gérer les unités --");
                    System.out.println("1. Ajouter une unité");
                    System.out.println("2. Supprimer une unité");
                    System.out.println("3. Modifier une unité");
                    System.out.print("Choix : ");
                    String uniteChoix = scanner.nextLine();
                    if (uniteChoix.equals("1")) {
                        uniteService.CRUD("unite", "add");
                    } else if (uniteChoix.equals("2")) {
                        uniteService.CRUD("unite", "delete");
                    } else if (uniteChoix.equals("3")) {
                        uniteService.CRUD("unite", "update");
                    } else {
                        System.out.println("❌ Choix invalide.");
                    }
                }

                case "3" -> {
                    System.out.println("\n-- Gérer les catégories --");
                    System.out.println("1. Ajouter une catégorie");
                    System.out.println("2. Supprimer une catégorie");
                    System.out.println("3. Modifier une catégorie");
                    System.out.print("Choix : ");
                    String catChoix = scanner.nextLine();
                    if (catChoix.equals("1")) {
                    	categorieService.CRUD("categorie", "add");
                    } else if (catChoix.equals("2")) {
                        categorieService.CRUD("categorie", "delete");
                    } else if (catChoix.equals("3")) {
                        categorieService.CRUD("categorie", "update");
                    } else {
                        System.out.println("❌ Choix invalide.");
                    }
                }
                case "4" -> {
                    System.out.println("\n-- Gérer les mouvements de stock --");
                    System.out.println("1. Gérer stock d'entrée");
                    System.out.println("2. Gérer stock de sortie");
                    System.out.println("3. Gérer les produits endommagés");
                    System.out.print("Choix : ");
                    String stockChoix = scanner.nextLine();

                    switch (stockChoix) {
	                    case "1" -> {
	                        System.out.println("\n1. Ajouter un stock d'entrée");
	                        System.out.println("2. Modifier un stock d'entrée");
	                        System.out.println("3. Afficher les stocks d'un produit");
	                        System.out.println("4. Chercher un stock d'un produit");
	                        System.out.println("5. Supprimer un stock ");
	                        System.out.println("6. Afficher les produit experer");
	                        System.out.print("Choix : ");
	                        String sousChoix = scanner.nextLine();
	
	                        switch (sousChoix) {
	                            case "1" -> new StockEntrerService().ajouterStockEntrer();
	                            case "2" -> new StockEntrerService().modifierStockEntrer();
	                            case "3" -> new StockEntrerService().afficherStocksEntrerProduit(); 
	                            case "4" -> new StockEntrerService().chercherStockParDate(); 
	                            case "5" -> new StockEntrerService().supprimerStock(); 
	                            case "6" -> new ProduitAlimentaireService().afficherPerteProduitAlimentaire(); 
	                            default -> System.out.println("❌ Choix invalide.");
	                        }
	                    }

	                    case "2" -> {
	                        System.out.println("\n1. Ajouter un stock de sortie");
	                        System.out.println("2. Modifier un stock de sortie");
	                        System.out.println("3. Afficher les stocks sortie d'un produit par date");
	                        System.out.print("Choix : ");
	                        String sousChoixSortie = scanner.nextLine();

	                        StockSortirService service = new StockSortirService();

	                        switch (sousChoixSortie) {
	                            case "1" -> service.stockSorti();
	                            case "2" -> service.modifierStockSorti();
	                            case "3" -> service.afficherStockSortiParDate();
	                            default -> System.out.println("❌ Choix invalide.");
	                        }
	                    }
	                    
	                    case "3" -> {
	                        System.out.println("\n🔹 Produits endommagés");
	                        System.out.println("1. Ajouter un produit endommagé");
	                        System.out.println("2. Afficher les produits endommagés");
	                        System.out.print("Choix : ");
	                        String sousChoixEndommage = scanner.nextLine();

	                        System.out.println("\n📦 Choisissez le type de produit :");
	                        System.out.println("1. Mécanique");
	                        System.out.println("2. Cuisine");
	                        System.out.print("Votre choix (1/2) : ");
	                        String choixType = scanner.nextLine();

	                        String typeProduit;
	                        GestionProduitEndommage service = null;

	                        switch (choixType) {
	                            case "1" -> {
	                                typeProduit = "mecanique";
	                                service = new PieceMecaniqueService();
	                            }
	                            case "2" -> {
	                                typeProduit = "cuisine";
	                                service = new MaterielCuisineService();
	                            }
	                            default -> {
	                                System.out.println("❌ Type invalide.");
	                                return;
	                            }
	                        }

	                        switch (sousChoixEndommage) {
	                            case "1" -> service.ajouterProduitEndommage(typeProduit);
	                            case "2" -> service.afficherProduitsEndommagesParNom();
	                            //case "3" -> service.supprimerProduitEndommage(typeProduit);
	                            //case "4" -> service.afficherProduitsEndommages(typeProduit);
	                            default -> System.out.println("❌ Choix invalide.");
	                        }
	                    }

                    }
                }
                case "5" -> {
                	 System.out.println("\n-- Statistiques --");
                	    System.out.println("1. Statistique d'une catégorie");
                	    System.out.println("2. Statistique d'un produit pendant les 5 dernières années");
                	    System.out.print("Choix : ");
                	    String statsChoix = scanner.nextLine();

                	    switch (statsChoix) {
                	        case "1" -> produitService.afficherStatistiquesConsommation();
                	        case "2" -> new StockService().afficherConsommationProduit();
                	        default -> System.out.println("❌ Choix invalide.");
                	    }
                }

                case "0" -> {
                    System.out.println("👋 Au revoir !");
                    return;
                }

                default -> System.out.println("❌ Choix invalide.");
            }
        }
    }
}
