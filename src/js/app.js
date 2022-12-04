document.addEventListener('DOMContentLoaded', function() {
  
  eventListeners();

  darkMode();
});

function darkMode() {

  const preferDarkMode = window.matchMedia('(prefers-color-scheme: dark)');

  if(preferDarkMode.matches) {
    document.body.classList.add('dark-mode');
  } else {
    document.body.classList.remove('dark-mode');
  }
  
  preferDarkMode.addEventListener('change', () => {
    if(preferDarkMode.matches) {
      document.body.classList.add('dark-mode');
    } else {
      document.body.classList.remove('dark-mode');
    }
  })

  const darkModeButton = document.querySelector('.dark-mode-button');

  darkModeButton.addEventListener('click', function() {
    document.body.classList.toggle('dark-mode');
  });

}

function eventListeners() {
  
  const mobileMenu = document.querySelector('.mobile-menu');

  mobileMenu.addEventListener('click', toggleMenu);
}

function toggleMenu(e) {
  const navigation = document.querySelector('.navigation');

  navigation.classList.toggle('show');
}