  document.addEventListener('DOMContentLoaded', function() {
            // Set actual food truck image - uncomment and update when integrating
            // const foodTruckUrl = 'imgs/truck.jpg';
            // document.querySelector('.carousel').style.backgroundImage = `url('${foodTruckUrl}')`;
          
            const plates = [
                { 
                    image: 'imgs/vecteezy_burger-and-fries-on-a-plate-on-a-white-background_55455098.png', 
                    title: 'Burger'
                },
                { 
                    image: 'imgs/vecteezy_ai-generated-chicken-satay-on-a-white-plate-on-transparent_36498077.png', 
                    title: 'Pizza'
                },
                { 
                    image: 'imgs/vecteezy_ai-generated-a-platter-of-flavorful-shawarma-with-tahini_36498050.png', 
                    title: 'Pasta'
                },
                { 
                    image: 'imgs/vecteezy_delicious-plate-of-tacos-al-pastor-topped-with-onions-and_57171473.png', 
                    title: 'Salad'
                },
                { 
                    image: 'imgs/burgerpng.png', 
                    title: 'Dessert'
                }
            ];

            const carouselTrack = document.querySelector('.carousel-track');
            const plateTitle = document.querySelector('.plate-title');
            const prevButton = document.querySelector('.prev-button');
            const nextButton = document.querySelector('.next-button');
            
            let currentIndex = 0;

            // Create carousel items
            plates.forEach((plate, index) => {
                const item = document.createElement('div');
                item.classList.add('carousel-item');
                if (index === currentIndex) {
                    item.classList.add('active');
                }
                
                const img = document.createElement('img');
                img.src = plate.image;
                img.alt = plate.title;
                
                item.appendChild(img);
                carouselTrack.appendChild(item);
            });

            // Initialize the carousel
            updateCarousel();

            // Event listeners for navigation buttons
            prevButton.addEventListener('click', () => {
                currentIndex = (currentIndex - 1 + plates.length) % plates.length;
                updateCarousel();
            });

            nextButton.addEventListener('click', () => {
                currentIndex = (currentIndex + 1) % plates.length;
                updateCarousel();
            });

            // Function to update carousel display
            function updateCarousel() {
                const items = document.querySelectorAll('.carousel-item');
                
                // Hide/show navigation buttons at ends
                prevButton.style.display = (currentIndex === 0) ? 'none' : 'flex';
                nextButton.style.display = (currentIndex === plates.length - 1) ? 'none' : 'flex';
                
                items.forEach((item, index) => {
                    item.classList.remove('active');
                    
                    // Calculate position relative to current
                    let position = index - currentIndex;
                    if (position < 0) position += plates.length;
                    position = position % plates.length;
                    
                    // Set positions
                    if (index === currentIndex) {
                        item.classList.add('active');
                        item.style.transform = 'translateX(0) scale(1) rotate(0deg)';
                        item.style.opacity = '1';
                        item.style.zIndex = '10';
                    } else if (position === 1 || (currentIndex === plates.length - 1 && index === 0)) {
                        // Next item
                        item.style.transform = 'translateX(60%) scale(0.8) rotate(45deg)';
                        item.style.opacity = '0.6';
                        item.style.zIndex = '5';
                    } else if (position === plates.length - 1 || (currentIndex === 0 && index === plates.length - 1)) {
                        // Previous item
                        item.style.transform = 'translateX(-60%) scale(0.8) rotate(-45deg)';
                        item.style.opacity = '0.6';
                        item.style.zIndex = '5';
                    } else {
                        // Hidden items
                        if (position < plates.length / 2) {
                            item.style.transform = 'translateX(100%) scale(0.5) rotate(90deg)';
                        } else {
                            item.style.transform = 'translateX(-100%) scale(0.5) rotate(-90deg)';
                        }
                        item.style.opacity = '0';
                        item.style.zIndex = '1';
                    }
                });
                
                // Update title
                plateTitle.textContent = plates[currentIndex].title;
            }

            // Add responsive handling
            window.addEventListener('resize', updateCarousel);

            // Add touch swipe support
            let touchStartX = 0;
            let touchEndX = 0;
            
            document.querySelector('.carousel').addEventListener('touchstart', e => {
                touchStartX = e.changedTouches[0].screenX;
            }, false);
            
            document.querySelector('.carousel').addEventListener('touchend', e => {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
            }, false);
            
            function handleSwipe() {
                if (touchEndX < touchStartX - 50) {
                    // Swipe left
                    nextButton.click();
                } else if (touchEndX > touchStartX + 50) {
                    // Swipe right
                    prevButton.click();
                }
            }

            // Function to adjust carousel to container size
            function adjustToContainer() {
                const container = document.querySelector('.carousel-wrapper');
                const carousel = document.querySelector('.carousel');
                
                // Dynamic adjustments based on container size
                const containerWidth = container.offsetWidth;
                const containerHeight = container.offsetHeight;
                
                // Adjust circle size based on container dimensions
                const circleSize = Math.min(containerWidth, containerHeight) * 0.5;
                const circle = document.querySelector('.carousel-circle');
                
                // Adjust font sizes and spacing based on container width
                if (containerWidth < 400) {
                    document.querySelector('.plate-title').style.fontSize = '1.2rem';
                    document.querySelector('.plate-menu').style.fontSize = '0.7rem';
                    document.querySelector('.see-more-btn').style.fontSize = '0.7rem';
                    document.querySelector('.see-more-btn').style.padding = '6px 12px';
                } else if (containerWidth < 600) {
                    document.querySelector('.plate-title').style.fontSize = '1.5rem';
                    document.querySelector('.plate-menu').style.fontSize = '0.8rem';
                    document.querySelector('.see-more-btn').style.fontSize = '0.8rem';
                    document.querySelector('.see-more-btn').style.padding = '7px 14px';
                } else {
                    document.querySelector('.plate-title').style.fontSize = '2.5rem';
                    document.querySelector('.plate-menu').style.fontSize = '1rem';
                    document.querySelector('.see-more-btn').style.fontSize = '0.9rem';
                    document.querySelector('.see-more-btn').style.padding = '8px 16px';
                }
            }
            
            // Run initial adjustment
            adjustToContainer();
            
            // Add resize listener for container changes
            window.addEventListener('resize', adjustToContainer);

            // Observer for container size changes 
            // Useful when parent containers change size without window resize
            if (typeof ResizeObserver !== 'undefined') {
                const resizeObserver = new ResizeObserver(entries => {
                    adjustToContainer();
                });
                resizeObserver.observe(document.querySelector('.carousel-wrapper'));
            }
        });