package services;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;

import main.Database;
import models.PieceMecanique;

public class PieceMecaniqueService extends ProduitService implements GestionProduitEndommage {

	public void ajouterPieceMecanique() {
	    PieceMecanique produit = new PieceMecanique();
	    super.ajouterProduit(produit);
	}
	
}


