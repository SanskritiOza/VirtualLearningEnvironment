function validateForm() {
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    const email = document.getElementById('email').value;
    const role = document.getElementById('role').value;

    // Validation checks
    if (username.length < 4) {
        alert('Username must be at least 4 characters long.');
        return false;
    }

    if (password.length < 6) {
        alert('Password must be at least 6 characters long.');
        return false;
    }

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert('Please enter a valid email address.');
        return false;
    }

    if (!role) {
        alert('Please select a role.');
        return false;
    }

    return true; // Submit the form if all checks pass
}


// Contact Form Submission with Validations
document.getElementById('contact-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const message = document.getElementById('message').value.trim();

    // Validation checks
    if (!name) {
        alert('Please enter your name.');
        return;
    }
    if (!validateEmail(email)) {
        alert('Please enter a valid email address.');
        return;
    }
    if (!message) {
        alert('Please enter your message.');
        return;
    }

    // Simulate email sending
    alert(`Thank you, ${name}! Your message has been sent.`);
});

function likeItem(courseId) {
    sendLikeDislikeRequest(courseId, 'like');
}

function dislikeItem(courseId) {
    sendLikeDislikeRequest(courseId, 'dislike');
}

function sendLikeDislikeRequest(courseId, action) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'like_dislike.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                console.log(response.message);
            } else {
                console.error(response.message);
            }
        }
    };
    xhr.send(`course_id=${courseId}&action=${action}`);
}








