package models;
import java.time.LocalDate;
import java.util.Scanner;

public class ProduitAlimentaire extends Produit {
	
    private LocalDate dateExpiration;
    
    public ProduitAlimentaire(int id_produit,String nom, int quantite, int id_unite, double prix, int id_categorie, LocalDate dateExpiration) {
        super(id_produit,nom, quantite, id_unite, prix, id_categorie, "alimentaire");
        this.dateExpiration = dateExpiration;
    }
    
    public ProduitAlimentaire() {
        super("alimentaire");
        this.dateExpiration = null;
    }

    public LocalDate getDateExpiration() { 
    	return dateExpiration; 
    	}
    
    public void setDateExpiration(LocalDate dateExpiration) { 
    	this.dateExpiration = dateExpiration; 
    	}
    
    public String getType() {
        return "alimentaire";
    }

    public void afficherDetails(String categorie, String unite) {
    	System.out.printf("║ %-18s ║ %-4d ║ %-6s ║ %-8.2f ║ %-18s ║ %-18s ║%n", 
            getNom(), getQuantite(), unite, getPrixUnitaire(),
            (getDateExpiration() != null ? getDateExpiration().toString() : "null"), 
            categorie);
    }
}

