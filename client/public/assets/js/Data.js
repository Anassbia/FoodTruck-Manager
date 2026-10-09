const menuData = [
    {
        id: 1,
        name: "Brief Pizza",
        description: "Barbecue Italian cuisine pizza",
        price: 190.85,
        image: "assets/img/update_2/menu/menu_1_1.png",
        category: "burger", // Added category for filtering
        discount: "24% OFF"
    },
    {
        id: 2,
        name: "Pasta Salad",
        description: "Chow mein Fried noodles",
        price: 160.85,
        image: "assets/img/update_2/menu/menu_1_2.png",
        category: "pizza",
        discount: "15% OFF"
    },
    {
        id: 3,
        name: "Vegetarian",
        description: "Cuisine Meal Health Food",
        price: 170.85,
        image: "assets/img/update_2/menu/menu_1_3.png",
        category: "burger",
        discount: "10% OFF"
    },
    {
        id: 4,
        name: "Tacos",
        description: "Delicious tacos with spicy fillings",
        price: 180.85,
        image: "assets/img/update_2/menu/menu_1_4.png",
        category: "tacos",
        discount: "5% OFF"
    },
    {
        id: 5,
        name: "Vegetarian",
        description: "Cuisine Meal Health Food",
        price: 170.85,
        image: "assets/img/update_2/menu/menu_1_5.png",
        category: "tacos",
        discount: "20% OFF"
    },
    {
        id: 6,
        name: "Pizza Supreme",
        description: "Extra cheese and toppings",
        price: 200.85,
        image: "assets/img/update_2/menu/menu_3_1.png",
        category: "pizza",
        discount: "15% OFF"
    },
    {
        id: 7,
        name: "Drinks",
        description: "Refreshing beverages",
        price: 120.85,
        image: "assets/img/update_2/menu/menu_3_2.png",
        category: "drinks",
        discount: "10% OFF"
    },
    {
        id: 8,
        name: "Sandwich",
        description: "Tasty sandwich with fresh ingredients",
        price: 130.85,
        image: "assets/img/update_2/menu/menu_3_3.png",
        category: "sanwitch",
        discount: "30% OFF"
    }
];

function getMenu() {
    return menuData;
}


let elementsFood = [];


$.ajax({
    url: '/listStock',
    method: 'GET',
    dataType: 'json',
    success: function(data) {
      console.log("Fetched data:", data);
      elementsFood = data;
      // steps('burger'); // Call function if needed
    },
    error: function(xhr, status, error) {
      console.error("Error fetching stock:", error);
      $('#output').text("Failed to fetch stocks.");
    }
  });



const cartItems = [
    {
        id: 1,
        name: 'Chicken Leg Piece',
        imageUrl: 'assets/img/food-1.png',
        price: 10.00,
        quantity: 1
    },
    {
        id: 2,
        name: 'Chicken Leg Piece',
        imageUrl: 'assets/img/food-2.png',
        price: 10.00,
        quantity: 1
    },
    {
        id: 3,
        name: 'Veggie Burger',
        imageUrl: 'assets/img/food-3.png',
        price: 8.50,
        quantity: 2
    }
];

const wishlistItems = [
    {
        id: 1,
        name: "Chicken Leg Piece",
        imageUrl: "assets/img/food-1.png",
        price: 10.00,
        addedDate: "2025-02-24",
        detailsUrl: "#QuickView"
    },
    {
        id: 2,
        name: "Chicken Leg Piece",
        imageUrl: "assets/img/food-2.png",
        price: 10.00,
        addedDate: "2025-03-24",
        detailsUrl: "shop-details.html"
    },
    {
        id: 3,
        name: "Chicken Leg Piece",
        imageUrl: "assets/img/food-3.png",
        price: 10.00,
        addedDate: "2025-03-25",
        detailsUrl: "shop-details.html"
    },
    {
        id: 4,
        name: "Chicken Leg Piece",
        imageUrl: "assets/img/food-3.png",
        price: 10.00,
        addedDate: "2025-04-24",
        detailsUrl: "shop-details.html"
    }
];

const users = [

    { fullName: "John Doe", email: "johndoe@example.com", password: "password123", dob: "1990-05-15" },
    { fullName: "Jane Smith", email: "janesmith@example.com", password: "password456", dob: "1985-08-25" }
];


const errorMessages = {
    "required":"Field is required.",
    "full-name": "Enter at least first and last name.",
    "dob":"You must be at least 18 years old!",
    "email": "Invalid email format.",
    "password": "Password must be at least 8 characters long.",
    "confirm-password": "Passwords do not match.",
    "phone":"Must start with 06 or 07 and be 10 digits long.",
    "existEmail":"Email already exist"
};

