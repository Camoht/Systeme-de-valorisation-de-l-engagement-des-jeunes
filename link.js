function copyLink() {
    var linkElement = document.getElementById("link");
    var link = new URL(linkElement.getAttribute("href"), window.location.href).href;
    
    // Copier le lien dans le presse-papiers
    navigator.clipboard.writeText(link).then(function() {
        alert("Le lien a été copié !");
    }, function() {
        alert("Impossible de copier le lien.");
    });
}