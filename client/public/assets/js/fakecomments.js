 const testimonials = [
        {
            text: "Food is absolutely amazing! Everything we ordered was fresh and full of flavor.",
            author: "Sara Johnson"
        },
        {
            text: "A hidden gem in the city! The food truck service is excellent.",
            author: "Mark Thompson"
        },
        {
            text: "This is not your average food truck. Delicious, affordable, and fast!",
            author: "Fatima El Amrani"
        },
        {
            text: "I always recommend this truck to friends. Never disappoints!",
            author: "Youssef Ben Ali"
        }
    ];

    const wrapper = document.getElementById("testimonial-wrapper");

    testimonials.forEach(t => {
        const slide = document.createElement("div");
        slide.className = "swiper-slide";
        slide.innerHTML = `
            <div class="ul-testimony">
                <span class="icon"><i class="flaticon-straight-quotes"></i></span>
                <p class="ul-testimony-txt">${t.text} <br><strong>– ${t.author}</strong></p>
            </div>
        `;
        wrapper.appendChild(slide);
    });

    // reinitialisation  
    if (typeof Swiper !== 'undefined') {
        new Swiper('.ul-testimonial-slider', {
            loop: true,
            autoplay: {
                delay: 3000,
            },
            slidesPerView: 1,
            spaceBetween: 20,
        });
    }

