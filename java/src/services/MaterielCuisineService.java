package services;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import main.Database;
import models.MaterielCuisine;

public class MaterielCuisineService extends ProduitService implements GestionProduitEndommage {

	public void ajouterMaterielCuisine() {
	    MaterielCuisine produit = new MaterielCuisine();
	    super.ajouterProduit(produit);
	}
	
}
