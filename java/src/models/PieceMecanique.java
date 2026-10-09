package models;

import java.util.Scanner;

public class PieceMecanique extends Produit {
    private String reference;
    Scanner scanner = new Scanner(System.in);

    public PieceMecanique(int id_produit,String nom, int quantite, int id_unite, double prix, int id_categorie, String reference) {
        super(id_produit,nom, quantite, id_unite, prix, id_categorie, "mecanique");
        this.reference=reference;
        
    }
    
    public PieceMecanique() {
        super("mecanique");
        do {
            System.out.print("Référence : ");
            this.reference = scanner.nextLine().trim();

            if (this.reference.isEmpty()) {
                System.out.println("❌ Référence ne peut pas être vide, veuillez réessayer !");
            }
        } while (this.reference.isEmpty());

    }

    public String getReference() { return reference; }
    public void setReference(String reference) { this.reference = reference; }
    public String getType() {
        return "mecanique";
    }
    
    public void afficherDetails(String categorie,String unite) {
    	System.out.printf("║ %-18s ║ %-4d ║ %-6s ║ %-8.2f ║ %-18s ║ %-18s ║%n", getNom(), getQuantite(), unite, getPrixUnitaire(),
                (getReference() != null ? getReference() : "-"),categorie);
    }

}

