<?php
class NavigationBar {
  public function render(){
    echo'
      <nav class="navbar">
        <a href="/">Home</a>
        <a href="#">Ferienwohnung 1</a>
        <a href="#">Ferienwohnung 2</a>
        <a href="#">Verfügbarkeit und Preise</a>
        <a href="#">Anreise</a>
      </nav>
    '; 
  }
}