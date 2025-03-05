
                const images = [
                    'images/future.png',
                    'images/IT.jpeg',
                    'images/logo.jpeg'
                ];

                let currentIndex = 0;
                const imageContainer = document.getElementById('images');

                function changeBackgroundImage() {
                    imageContainer.style.opacity = 0;
                    setTimeout(() => {
                    currentIndex = (currentIndex + 1) % images.length;
                    imageContainer.style.backgroundImage = `url('${images[currentIndex]}')`;
                    imageContainer.style.opacity = 1;
                },1000); }

                setInterval(changeBackgroundImage, 6000);
