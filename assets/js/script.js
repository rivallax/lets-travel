document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector(".menu-toggle");
    const header = document.querySelector(".header");
    const navbar = document.querySelector(".navbar");

    menuToggle.addEventListener("click", () => {
        header.classList.toggle("active");
    });

    document.addEventListener("click", function (e) {
        if (
            !header.contains(e.target) &&
            !menuToggle.contains(e.target) &&
            !navbar.contains(e.target)
        ) {
            header.classList.remove("active");
        }
    });

    function formatRupiah(amount) {
        return (
            "Rp" +
            amount.toLocaleString("id-ID", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2,
            })
        );
    }

    const paxInput = document.getElementById("pax");
    const totalPriceElements = document.querySelectorAll(".total-price");
    const totalPriceInputs = document.querySelectorAll(".total-price-input");
    const priceInput = document.querySelector(".price-input");

    if (
        paxInput &&
        totalPriceElements.length > 0 &&
        totalPriceInputs.length > 0 &&
        priceInput
    ) {
        const updateTotalPrice = () => {
            const pax = parseInt(paxInput.value, 10) || 1;
            const pricePerPax = parseFloat(priceInput.value) || 0;

            const totalPrice = pax * pricePerPax;
            totalPriceElements.forEach(
                (el) => (el.textContent = formatRupiah(totalPrice))
            );
            totalPriceInputs.forEach(
                (input) => (input.value = totalPrice.toFixed(2))
            );
        };

        if (!paxInput.value) paxInput.value = 1;
        if (!priceInput.value) priceInput.value = 0;

        updateTotalPrice();

        paxInput.addEventListener("input", updateTotalPrice);
    }

    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        const close = document.querySelectorAll(".close-btn");
        modal.style.display = "block";
        close.forEach((btn) => {
            btn.onclick = function () {
                modal.style.display = "none";
                window.location.hash = "";
            };
        });

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
                window.location.hash = "";
            }
        };
    }

    function openCartModal(destinationId, price, isLoggedIn, urlLogin) {
        const cartModal = document.getElementById("cart-modal");
        const destinationInput = document.getElementById("destination-id");
        const priceInputInModal = document.querySelector(".price-input");

        if (!isLoggedIn) {
            window.location.href = urlLogin;
            return;
        }

        if (destinationInput && priceInputInModal) {
            destinationInput.value = destinationId;
            priceInputInModal.value = price;

            updateTotalPriceInModal();
        }

        if (cartModal) {
            cartModal.style.display = "block";
        }
    }

    function updateTotalPriceInModal() {
        const paxInputInModal = document.getElementById("pax");
        const priceInputInModal = document.querySelector(".price-input");
        const totalPriceElementInModal = document.querySelector(".total-price");
        const totalPriceInputInModal =
            document.querySelector(".total-price-input");

        const paxValue = parseInt(paxInputInModal.value, 10);
        const price = parseFloat(priceInputInModal.value) || 0;

        let totalPrice;

        if (isNaN(paxValue) || paxValue <= 0) {
            totalPrice = 0;
        } else {
            totalPrice = paxValue * price;
        }

        if (totalPriceElementInModal) {
            totalPriceElementInModal.textContent = formatRupiah(totalPrice);
        }
        if (totalPriceInputInModal) {
            totalPriceInputInModal.value = totalPrice.toFixed(2);
        }
    }

    const paxInputInModal = document.getElementById("pax");
    if (paxInputInModal) {
        paxInputInModal.addEventListener("input", updateTotalPriceInModal);
    }

    function closeCartModal() {
        const cartModal = document.getElementById("cart-modal");
        if (cartModal) {
            cartModal.style.display = "none";
        }
    }

    const closeModalButtons = document.querySelectorAll(".close-btn");
    closeModalButtons.forEach((button) =>
        button.addEventListener("click", closeCartModal)
    );

    window.addEventListener("click", function (event) {
        const cartModal = document.getElementById("cart-modal");
        if (event.target === cartModal) {
            closeCartModal();
        }
    });

    const addToCartButton = document.querySelector(".add-to-cart");
    const cartForm = document.getElementById("cart-form");
    if (addToCartButton && cartForm) {
        addToCartButton.addEventListener("click", function () {
            const formData = new FormData(cartForm);

            fetch(cartForm.action, {
                method: "POST",
                body: formData,
            })
                .then((response) => response.text())
                .then((text) => {
                    console.log("Response text:", text);
                    try {
                        const data = JSON.parse(text);
                        if (data.success) {
                            alert("Item added to cart successfully!");
                            closeCartModal();
                        } else {
                            alert("Failed to add item to cart.");
                        }
                    } catch (error) {
                        console.error("Error parsing JSON:", error);
                        alert("An error occurred while adding item to cart.");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("An error occurred while adding item to cart.");
                });
        });
    }

    const cartButtons = document.querySelectorAll(".cart-btn-cta");
    cartButtons.forEach((button) => {
        button.addEventListener("click", function (event) {
            event.stopPropagation();
            const destinationId = button.getAttribute("data-id");
            const price = parseFloat(button.getAttribute("data-price")) || 0;
            const isLoggedIn = button.getAttribute("data-session") === "true"; // Memeriksa jika nilai adalah 'true'
            const urlLogin = button.getAttribute("data-login-url");
            openCartModal(destinationId, price, isLoggedIn, urlLogin);
        });
    });

    document
        .querySelectorAll("#destinations .content .card")
        .forEach((card) => {
            card.addEventListener("click", function () {
                const button = card.querySelector(".btn-primary");
                if (button) {
                    const href = button.getAttribute("href");
                    const destinationId = href.split("/").pop();
                    const baseUrl = "http://localhost/lets-travel/public";
                    const newUrl = `${baseUrl}/destinations/detail/${destinationId}`;
                    window.location.href = newUrl;
                }
            });

            const addToCartBtn = card.querySelector(".btn-icon");
            if (addToCartBtn) {
                const destinationId = card.dataset.destinationId;
                addToCartBtn.addEventListener("click", function (e) {
                    e.stopPropagation();
                    handleCartButtonClick(addToCartBtn, destinationId);
                });
            }
        });

    function handleCartButtonClick(button, destinationId = null) {
        button.addEventListener("click", function (e) {
            e.stopPropagation();
            if (destinationId) {
                console.log(
                    `Clicked cart button for destinationId: ${destinationId}`
                );
            }
        });
    }

    const comments = document.querySelectorAll(".comment-text");
    comments.forEach((comment) => {
        if (comment.scrollHeight > comment.clientHeight) {
            comment.nextElementSibling.classList.add("visible");
        }
    });

    function toggleComment(link) {
        const comment = link.previousElementSibling;

        if (comment.classList.contains("full")) {
            comment.classList.remove("full");
            link.textContent = "Lihat selengkapnya";
        } else {
            comment.classList.add("full");
            link.textContent = "Lihat lebih sedikit";
        }
    }

    document.addEventListener("click", function (event) {
        if (
            event.target.matches(".increment-btn") ||
            event.target.matches(".decrement-btn")
        ) {
            const input = event.target
                .closest(".input-counter")
                .querySelector(".quantity-input");

            let value = parseInt(input.getAttribute("data-pax")) || 0;

            if (event.target.matches(".increment-btn")) {
                value += 1;
            } else if (event.target.matches(".decrement-btn")) {
                if (value > 1) {
                    value -= 1;
                }
            }

            input.value = value;

            input.setAttribute("data-pax", value);
        }
    });
});

window.addEventListener("load", function () {
    const scrollToSection = (element) => {
        const targetElement = document.querySelector(element);
        if (targetElement) {
            targetElement.scrollIntoView({ behavior: "smooth" });
        }
    };

    const hash = window.location.hash;
    if (hash) {
        scrollToSection(hash);
    }

    window.addEventListener("hashchange", function () {
        const newHash = window.location.hash;
        if (newHash) {
            scrollToSection(newHash);
        }
    });

    const dropdownToggle = document.querySelector(".dropdown-toggle");
    const dropdownMenu = document.querySelector(".dropdown-menu");

    if (dropdownToggle && dropdownMenu) {
        dropdownToggle.addEventListener("click", function () {
            dropdownMenu.classList.toggle("show");
        });

        document.addEventListener("click", function (event) {
            if (
                !dropdownToggle.contains(event.target) &&
                !dropdownMenu.contains(event.target)
            ) {
                dropdownMenu.classList.remove("show");
            }
        });
    }
});
