  ;[].forEach.call(document.getElementsByClassName("mailto"), function(el) {
  el.setAttribute("href", "mailto:" + el.getAttribute("data-mailto-user") + "@" + (el.getAttribute("data-mailto-domain") || window.location.host))
  });
  