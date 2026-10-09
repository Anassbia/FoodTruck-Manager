$(document).ready(function () {
    function displayWishlist() {
        const tableBody = $("#wishlistTable");
        tableBody.empty(); // Nettoyer avant d'afficher

        wishlistItems.forEach(item => {
            const row = `
                <tr>
                    <td>
                        <div class="ul-cart-product">
                            <a href="${item.detailsUrl}" class="popup-content ul-cart-product-img">
                                <img src="${item.imageUrl}" alt="Product">
                            </a>
                        </div>
                    </td>
                    <td>
                        <a href="${item.detailsUrl}" class="popup-content ul-cart-product-title">${item.name}</a>
                    </td>
                    <td><span class="ul-cart-item-price">$${item.price.toFixed(2)}</span></td>
                    <td><span class="ul-cart-item-date">${item.addedDate}</span></td>
                    <td>
                        <div class="ul-cart-item-remove">
                            <button class="removeWishlistItem" data-id="${item.id}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
            tableBody.append(row);
        });
    }

    // Supprimer un élément du wishlist
    $(document).on("click", ".removeWishlistItem", function () {
        const itemId = $(this).data("id");
        const index = wishlistItems.findIndex(item => item.id === itemId);
        if (index !== -1) {
            wishlistItems.splice(index, 1);
            displayWishlist(); // Recharger l'affichage
        }
    });

    // Affichage initial
    displayWishlist();
});