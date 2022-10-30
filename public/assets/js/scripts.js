// Menu hambuger //
const hamburgerToggler = document.querySelector(".hamburger");
const navLinksContainer = document.querySelector(".navlinks-container");

const toggleNav = () => {
  hamburgerToggler.classList.toggle("open")

  const ariaToggle = hamburgerToggler.getAttribute("aria-expanded") === "true" ? "false" : "true";
  hamburgerToggler.setAttribute("aria-expanded", ariaToggle)

  navLinksContainer.classList.toggle("open")
}
hamburgerToggler.addEventListener("click", toggleNav);
console.log(toggleNav);

new ResizeObserver(entries => {
  if (entries[0].contentRect.width <= 1000) {
    navLinksContainer.style.transition = "transform 0.3s ease-out"
  } else {
    navLinksContainer.style.transition = "none"
  }
}).observe(document.body);


// confirmation de sécurité A chaque modification ou suppression //
const btn = document.querySelector('#btn');

function evenement() {
  alert('Veuillez confirmer votre choix')
}

btn.addEventListener("click", evenement);


// Barre de recherche dynamique //
const searchBar = document.querySelector("#searchbar");

searchBar.addEventListener("keyup", (e) => {
  const searchedLetters = e.target.value;
  const cards = document.querySelectorAll(".card");
  filterElements(searchedLetters, cards);
});

function filterElements(letters, elements) {
  for (let i = 0; i < elements.length; i++) {
    if (elements[i].textContent.toLowerCase().includes(letters)) {
      elements[i].style.display = "block";
    } else {
      elements[i].style.display = "none";
    }
  }
}

