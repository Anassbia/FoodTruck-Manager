package models;

import java.time.LocalDate;

public class ProduitEndommage {
	
    private int id;
    private int id_ST; 
    private int quantite;
    private String description;
    private LocalDate date_signalement;

    public ProduitEndommage() {}

    public ProduitEndommage(int idST, int quantite, String description, LocalDate dateSignalement) {
        this.id_ST = idST;
        this.quantite = quantite;
        this.description = description;
        this.date_signalement = dateSignalement;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public int getIdST() {
        return id_ST;
    }

    public void setIdST(int idST) {
        this.id_ST = idST;
    }

    public int getQuantite() {
        return quantite;
    }

    public void setQuantite(int quantite) {
        this.quantite = quantite;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public LocalDate getDateSignalement() {
        return date_signalement;
    }

    public void setDateSignalement(LocalDate dateSignalement) {
        this.date_signalement = dateSignalement;
    }
}
