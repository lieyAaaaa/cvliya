document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS (Animate on Scroll)
    AOS.init({
        duration: 800,
        once: true, // whether animation should happen only once - while scrolling down
        offset: 50, // offset (in px) from the original trigger point
    });

    // Typing effect for the homepage
    const typingElement = document.getElementById('typing-effect');
    if (typingElement) {
        const text = "Siswa Kelas 11 | Rekayasa Perangkat Lunak";
        let index = 0;
        
        function type() {
            if (index < text.length) {
                typingElement.textContent += text.charAt(index);
                index++;
                setTimeout(type, 80);
            } else {
                // Remove cursor after typing is done
                const cursor = document.querySelector('.typing-cursor');
                if(cursor) cursor.style.display = 'none';
            }
        }
        
        // Clear existing text and start typing
        typingElement.textContent = '';
        setTimeout(type, 500); // Start after a short delay
    }
});
