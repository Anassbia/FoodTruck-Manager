package models;

import java.util.Scanner;

import services.categorie_unite;

public abstract class Produit {
	
    protected int id_produit;
    protected String nom;
    protected int quantite = 0;
    private int id_unite; 
    protected double prixUnitaire = 0;
    protected int id_categorie;
    protected String type;

    public Produit(String type) {
    	Scanner scanner = new Scanner(System.in);

        System.out.print("Nom du produit : ");
        this.nom = scanner.nextLine();
        
        categorie_unite manager = new categorie_unite();

     manager.afficherListe("unite");

     boolean uniteValide = false;
     do {
         System.out.print("Unité (Numéro) : ");
         if (scanner.hasNextInt()) {
             int saisieUnite = scanner.nextInt();

             if (manager.idExiste("unite", saisieUnite)) {
                 this.id_unite = saisieUnite;
                 uniteValide = true;
             } else {
                 System.out.println("❌ Numéro d'unité invalide, veuillez réessayer !");
             }
         } else {
             System.out.println("❌ Entrée invalide (pas un nombre), veuillez réessayer !");
             scanner.next();
         }
     } while (!uniteValide);

     manager.afficherListe("categorie");

     boolean categorieValide = false;
     do {
         System.out.print("Numéro de la catégorie : ");
         if (scanner.hasNextInt()) {
             int saisieCategorie = scanner.nextInt();

             if (manager.idExiste("categorie", saisieCategorie)) {
                 this.id_categorie = saisieCategorie;
                 categorieValide = true;
             } else {
                 System.out.println("❌ Numéro de catégorie invalide, veuillez réessayer !");
             }
         } else {
             System.out.println("❌ Entrée invalide (choisir un nombre), veuillez réessayer !");
             scanner.next(); 
         }
     } while (!categorieValide);

     scanner.nextLine();

        
        this.type = type;
        
    }
    
    public Produit(int id_produit,String nom, int quantite,int id_unite, double prixUnitaire, int id_categorie, String type) {
    	this.id_produit= id_produit;
        this.nom = nom;
        this.quantite = quantite;
        this.id_unite = id_unite;
        this.prixUnitaire = prixUnitaire;
        this.id_categorie = id_categorie;
        this.type = type;
    }
    
    public abstract void afficherDetails(String categorie,String unite);

   
    // Getters
    
    public int getIdProduit() {
        return id_produit;
    }
    
    public void setIdProduit(int idProduit) {
        this.id_produit = idProduit;
    }

    public String getNom() {
        return nom;
    }

    public int getQuantite() {
        return quantite;
    }

    public int getId_Unite() {
        return id_unite;
    }

    public double getPrixUnitaire() {
        return prixUnitaire;
    }

    public int getId_categorie() {
        return id_categorie;
    }

    public String getType() {
        return type;
    }

    // Setters

    public void setNom(String nom) {
        this.nom = nom;
    }

    public void setQuantite(int quantite) {
        this.quantite = quantite;
    }

    public void setUnite(int id_unite) {
        this.id_unite = id_unite;
    }

    public void setPrixUnitaire(double prixUnitaire) {
        this.prixUnitaire = prixUnitaire;
    }

    public void setId_categorie(int id_categorie) {
        this.id_categorie = id_categorie;
    }

    public void setType(String type) {
        this.type = type;
    }
    
}


