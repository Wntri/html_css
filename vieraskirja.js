$(document).ready(() => {
  $("#guestbook-form").submit((event) => {
    event.preventDefault(); // Estä lomakkeen oletustoiminto (sivun uudelleenlataus)

    // Hanki lomakkeen tiedot
    const formData = $(event.currentTarget).serialize();

    // Lähetä AJAX-pyyntö palvelimelle
    $.ajax({
      type: "POST",
      url: "tallenna_vieraskirja.php", // Palvelinpään käsittelijän polku
      data: formData,
      success: (response) => {
        // Tyhjennä lomake ja lataa uudelleen vieraskirjan merkinnät
        $("#title").val("");
        $("#message").val("");
        loadGuestbookEntries();
      },
    });
  });

  // Lataa vieraskirjan merkinnät kun sivu ladataan
  loadGuestbookEntries();
});

function loadGuestbookEntries() {
  // Lataa AJAX-pyynnöllä vieraskirjan merkinnät palvelimelta ja päivitä #guestbook-entries-div
  $.ajax({
    type: "GET",
    url: "hae_vieraskirja_merkinnat.php", // Palvelinpään käsittelijän polku
    success: (response) => {
      $("#guestbook-entries").html(response);
    },
  });
}
