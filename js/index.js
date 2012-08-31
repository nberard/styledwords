$(document).ready(function(){
	$("ul.notes-echelle").addClass("js");
	// On passe chaque note � l'�tat gris� par d�faut
	$("ul.notes-echelle li").addClass("note-off");
	// Au survol de chaque note � la souris
	$("ul.notes-echelle li").mouseover(function() {
		// On passe les notes sup�rieures � l'�tat inactif (par d�faut)
		$(this).nextAll("li").addClass("note-off");
		// On passe les notes inf�rieures � l'�tat actif
		$(this).prevAll("li").removeClass("note-off");
		// On passe la note survol�e � l'�tat actif (par d�faut)
		$(this).removeClass("note-off");
	});
	// Lorsque l'on sort du syt�me de notation � la souris
	$("ul.notes-echelle").mouseout(function() {
		// On passe toutes les notes � l'�tat inactif
		$(this).children("li").addClass("note-off");
		// On simule (trigger) un mouseover sur la note coch�e s'il y a lieu
		$(this).find("li input:checked").parent("li").trigger("mouseover");
	});
});