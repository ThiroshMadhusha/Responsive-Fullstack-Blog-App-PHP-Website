const navItems = document.querySelector(".nav__items");
const openNavBtn = document.querySelector("#open__nav-btn");
const closeNavBtn = document.querySelector("#close__nav-btn");

// nav bar
const openNav = () => {
  navItems.style.display = "flex";
  openNavBtn.style.display = "none";
  closeNavBtn.style.display = "inline-block";
};

// nav bar
const closeNav = () => {
  navItems.style.display = "none";
  openNavBtn.style.display = "inline-block";
  closeNavBtn.style.display = "none";
};
openNavBtn.addEventListener("click", openNav);
closeNavBtn.addEventListener("click", closeNav);


// Sidebar for admin panel in mobille response

const sidebar = document.querySelector('aside');
const showSidebarBtn = document.querySelector("#show__sidebar-btn");
const hideSidebarBtn = document.querySelector("#hide__sidebar-btn");


// Show sidebar on small devices
const showSidebar = () => {
  sidebar.style.left = '0';
  showSidebarBtn.style.display = 'none';
  hideSidebarBtn.style.display = 'inline-block';
}

// Hide sidebar on small devices
const hideSidebar = () => {
  sidebar.style.left = '-100%';
  showSidebarBtn.style.display = 'inline-block';
  hideSidebarBtn.style.display = 'none';
}


showSidebarBtn.addEventListener('click', showSidebar)
hideSidebarBtn.addEventListener("click", hideSidebar);