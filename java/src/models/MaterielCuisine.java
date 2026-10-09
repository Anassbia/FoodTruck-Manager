package models;

import java.util.Scanner;

 public class MaterielCuisine extends Produit {
	
	Scanner scanner = new Scanner(System.in);
	
    public MaterielCuisine(int id_produit,String nom,int quantite, int id_unite,double prix, int id_categorie) {
        super(id_produit,nom, quantite, id_unite, prix, id_categorie, "materiel");
    }
    public MaterielCuisine() {
        super("mecanique");
    }
    
    public String getType() {
        return "cuisine";
    }
  
    public void afficherDetails(String categorie,String unite) {
    	System.out.printf("║ %-18s ║ %-4d ║ %-6s ║ %-8.2f ║ %-18s ║%n", getNom(), getQuantite(), unite, getPrixUnitaire(), categorie);
    }

 }
