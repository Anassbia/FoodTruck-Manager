package models;

import java.util.Scanner;
import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.time.format.DateTimeParseException;

public class StockEntrer extends Stock {
	
    private int idST;
    private int quantiteActuel;
    private LocalDate dateReception;
    private LocalDate dateExpiration;
    private double prix;
    
    Scanner scanner = new Scanner(System.in);
    
    public StockEntrer() {
        
    }
    
    public StockEntrer(int idST, int idProduit, int quantite, int quantiteActuel, double prix, LocalDate dateReception, LocalDate dateExpiration) {
        super(idProduit, quantite);
        this.idST = idST;
        this.quantiteActuel = quantiteActuel;
        this.prix = prix;
        this.dateReception = dateReception;
        this.dateExpiration = dateExpiration;
    }
   
    public StockEntrer(String type) {
    	 super();
    	 
    	 DateTimeFormatter formatter = DateTimeFormatter.ofPattern("yyyy-MM-dd");

    	 do {
    	     System.out.print("Date de réception (yyyy-MM-dd) : ");
    	     String input = scanner.nextLine();
    	     try {
    	         this.dateReception = LocalDate.parse(input, formatter);
    	         break; // si pas d'exception ➔ date valide ➔ on sort
    	     } catch (DateTimeParseException e) {
    	         System.out.println("❌ Format de date invalide, veuillez réessayer (yyyy-MM-dd) !");
    	     }
    	 } while (true);


        if (type.equalsIgnoreCase("alimentaire")) {
            while (true) {
                try {
                    System.out.print("Date d’expiration (yyyy-MM-dd) : ");
                    this.dateExpiration = LocalDate.parse(scanner.nextLine(), formatter);

                    if (!this.dateExpiration.isAfter(LocalDate.now())) {
                        System.out.println("❌ La date d’expiration doit être dans le futur !");
                    } else {
                        break;
                    }
                } catch (DateTimeParseException e) {
                    System.out.println("❌ Format de date invalide. Réessayez !");
                }
            }
        }

        this.quantiteActuel = getQuantite();

        do {
            System.out.print("Prix de stock : ");
            if (scanner.hasNextDouble()) {
                this.prix = scanner.nextDouble();
                if (this.prix >= 0) {
                    break; 
                } else {
                    System.out.println("❌ Le prix doit être un nombre positif !");
                }
            } else {
                System.out.println("❌ Entrée invalide (pas un nombre), veuillez réessayer !");
                scanner.next();
            }
        } while (true);

        scanner.nextLine();

    }

    public int getIdST() { return idST; }
    public void setIdST(int idST) { this.idST = idST; }

    public int getQuantiteActuel() { return quantiteActuel; }
    public void setQuantiteActuel(int quantiteActuel) { this.quantiteActuel = quantiteActuel; }

    public LocalDate getDateReception() { return dateReception; }
    public void setDateReception(LocalDate dateReception) { this.dateReception = dateReception; }

    public LocalDate getDateExpiration() { return dateExpiration; }
    public void setDateExpiration(LocalDate dateExpiration) { this.dateExpiration = dateExpiration; }

    public double getPrix() { return prix; }  
    public void setPrix(double prix) { this.prix = prix; } 
}
