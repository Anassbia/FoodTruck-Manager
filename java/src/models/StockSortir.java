package models;

import java.time.LocalDate;
import java.time.format.DateTimeFormatter;
import java.time.format.DateTimeParseException;
import java.util.Scanner;

public class StockSortir extends Stock {
	
    private int idSS;
    private int idST;
    private LocalDate dateSortir;

    Scanner scanner = new Scanner(System.in);
    DateTimeFormatter formatter = DateTimeFormatter.ofPattern("yyyy-MM-dd");

    public StockSortir(int idST, int idProduit, int quantite, LocalDate dateSortir) {
        super(idProduit, quantite);
        this.idST = idST;
        this.dateSortir = dateSortir;
    } 
    
    public StockSortir() {
        super(); 
       
        do {
            System.out.print("Date de sortie (yyyy-MM-dd) : ");
            String input = scanner.nextLine();
            try {
                this.dateSortir = LocalDate.parse(input, formatter);
                break; 
            } catch (DateTimeParseException e) {
                System.out.println("❌ Format de date invalide, veuillez réessayer (yyyy-MM-dd) !");
            }
        } while (true);

    }

    public int getIdSS() { return idSS; }
    public void setIdSS(int idSS) { this.idSS = idSS; }
    public int getIdST() { return idST; }
    public void setIdST(int idST) { this.idST = idST; }
    public LocalDate getDateSortir() { return dateSortir; }
    public void setDateSortir(LocalDate dateSortir) { this.dateSortir = dateSortir; }
}
