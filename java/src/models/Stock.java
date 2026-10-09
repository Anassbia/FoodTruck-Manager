package models;

import java.util.Scanner;

public abstract class Stock {
	
    private int idProduit;
    private int quantite;

    public Stock() {
        Scanner scanner = new Scanner(System.in);

        do {
            System.out.print("Quantité : ");
            if (scanner.hasNextInt()) {
                this.quantite = scanner.nextInt();
                if (this.quantite >= 0) { 
                    break;
                } else {
                    System.out.println("❌ La quantité doit être un nombre positif !");
                }
            } else {
                System.out.println("❌ Entrée invalide (pas un nombre), veuillez réessayer !");
                scanner.next();
            }
        } while (true);

        scanner.nextLine();

    }

    public Stock(int idProduit, int quantite) {
        this.idProduit = idProduit;
        this.quantite = quantite;
    }
    
    public int getIdProduit() { return idProduit; }
    public void setIdProduit(int idProduit) { this.idProduit = idProduit; }
    public int getQuantite() { return quantite; }
    public void setQuantite(int quantite) { this.quantite = quantite; }
}

