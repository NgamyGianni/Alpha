var marker0 =  new google.maps.Marker({position: {query:document.getElementById('start').value}, map: map});
var marker1 =  new google.maps.Marker({position: {query:document.getElementById('produit 1').value}, map: map});
var marker2 =  new google.maps.Marker({position: {query:document.getElementById('produit 2').value}, map: map});
var marker3 =  new google.maps.Marker({position: {query:document.getElementById('produit 3').value}, map: map});

let comparer(point, listePoints) { 
// renvoie le lieu de la liste passée en paramètre le plus proche du point passé en param
	let nbPoints = listePoints.length;
	if (nbPoints < 1 ) {
		return 0;
	}
	let plusProche = listePoints[0];
	let i;
	let indice = 0;
	for (i = 1; i < nbPoints; i++) {
		if (distance(point, plusProche) > distance(point, listePoints[i])) {
			plusProche = listePoints[i];
			indice = i;
		}
	}
	listePoints.splice(indice,1);//on retire de la liste l'élément le plus proche
	return plusProche;
}

let creerCheckpoints(point, listePoints) {
// utilise comparer pour creer un trajet optimisé
	let nbPoints = listePoints.length;
	let i;
	let checkpoints = [point];
	for (i = 0; i < nbPoints; i++) {
		checkpoints.push(comparer(checkpoints[i],listePoints));
	}
	return checkpoints;
}

/!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ 
let distance(start, finish) {
	dist = DistanceMatrixService();
	return dist;
}
/!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\ /!WIP!\
