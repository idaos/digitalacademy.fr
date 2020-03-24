var chart_data = {
	"2019": [
		{ 
			"value": "96", 
			"course": "Inbound Marketing" 
		},{ 
			"value": "96", 
			"course": "Maîtriser les fondamentaux des médias sociaux" 
		},{ 
			"value": "100", 
			"course": "RP 2.0 : Relation presse, blogueurs, Twitter" 
		},{ 
			"value": "100", 
			"course": "RH 2.0 : recruter sur les réseaux sociaux" 
		},{ 
			"value": "98", 
			"course": "Inbound Marketing" 
		},{ 
			"value": "86", 
			"course": "Gérer la relation client et intéragir sur les médias sociaux" 
		},{ 
			"value": "97", 
			"course": "Panorama des réseaux sociaux" 
		},{ 
			"value": "80", 
			"course": "Panorama des réseaux sociaux" 
		},{ 
			"value": "80", 
			"course": "Web social" 
		},{ 
			"value": "100", 
			"course": "Web social : LinkedIn" 
		},{ 
			"value": "95", 
			"course": "Panorama des réseaux sociaux" 
		},{ 
			"value": "95", 
			"course": "Inbound Marketing" 
		},{ 
			"value": "80", 
			"course": "Booster son marketing et sa prospection sur LinkedIn" 
		},{ 
			"value": "100", 
			"course": "LinkedIn Perfectionnement" 
		},{ 
			"value": "98", 
			"course": "Communiquer par l'image : Picture Marketing" 
		},{ 
			"value": "97", 
			"course": "Email marketing" 
		},{ 
			"value": "89", 
			"course": "Choisir et piloter ses prestataires web" 
		}
	],
	"2018": [
		{ 
			"value": "95", 
			"course": "Maîtriser les fondamentaux de LinkedIn" 
		},{ 
			"value": "100", 
			"course": "Maîtriser les fondamentaux de Twitter" 
		},{ 
			"value": "100", 
			"course": "RP 2.0 : Relation presse, blogueurs, Twitter" 
		},{ 
			"value": "98", 
			"course": "Maîtriser les fondamentaux de Twitter" 
		},{ 
			"value": "100", 
			"course": "RP 2.0 : Relation presse, blogueurs, Twitter" 
		},{ 
			"value": "85", 
			"course": "Maîtrise le Display" 
		},{ 
			"value": "92", 
			"course": "RH 2.0" 
		},{ 
			"value": "82", 
			"course": "RP 2.0 : Relation presse, blogueurs, Twitter" 
		},{ 
			"value": "84",
			"course": "Publicité Facebook et Instagram : de la stratégie aux résultats" 
		},{ 
			"value": "88", 
			"course": "RH 2.0" 
		},{ 
			"value": "90", 
			"course": "Formation Réseaux Sociaux" 
		},{ 
			"value": "90", 
			"course": "Les réseaux sociaux au service de la..." 
		}
	]
}


var chart_wrp = document.getElementById("chart-wrp");

Object.keys(chart_data).forEach(function(key, idx, arr) {

	var toggle_arrow = createElementWithClass("div", "toggable-btn");
	toggle_arrow.innerHTML = "Découvrir la satisfaction de nos clients en " + key;
	var toggle_content = createElementWithClass("div", "toggable-content");
	var chart_year = createElementWithClass("div", "year");
	var chart_year_val = createElementWithClass("h3", "value");
	chart_year_val.innerHTML = 'Taux de satisfaction de nos apprenants en ' + key;
	var chart_items = createElementWithClass("div", "items");
	var average_count = 0;

	// first element stay open..
	if (idx === arr.length - 1){ 
		toggle_arrow.classList.add("toggaled");
		toggle_content.setAttribute("style", "display:block;");
	}

	for (var i = 0; i < chart_data[key].length; i++) {

		average_count += parseInt(chart_data[key][i]["value"]);

		var item_value = createElementWithClass("div", "value-" + chart_data[key][i]["value"]);
		item_value.innerHTML = chart_data[key][i]["value"] + "%";
		var item_course = createElementWithClass("div", "course");
		item_course.innerHTML = "Formation : " + chart_data[key][i]["course"];

		var item = createElementWithClass("div", "item");
		var triangle = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><polygon fill="#fff" points="0,0 100,100 0,100"></polygon></svg>';
		item.innerHTML = triangle;
		item.appendChild(item_value);
		item.appendChild(item_course);
		chart_items.appendChild(item);
	}

	var average = average_count / chart_data[key].length;
	average = average.toFixed(0)
	average_elt = createElementWithClass("div", "average-" + average);
	average_elt.innerHTML = average + "%"

	var heading = createElementWithClass("div", "chart_heading")
	var hr = document.createElement('hr');


	heading.appendChild(average_elt);
	heading.appendChild(chart_year_val);
	heading.appendChild(hr);

	toggle_content.appendChild(heading);
	toggle_content.appendChild(chart_items);
	chart_year.classList.add("toggable");
	chart_year.appendChild(toggle_arrow);
	chart_year.appendChild(toggle_content);
	chart_wrp.appendChild(chart_year);
})

function createElementWithClass(htmlElement, cssClass){
	var item = document.createElement(htmlElement);
	item.className = cssClass;
	return item;
}



jQuery(document).ready(function(){

	jQuery( ".toggable-btn" ).click(function() {
		jQuery( this ).innerHTML = "Réduire";
	});
	jQuery( ".toggable-btn" ).last().trigger( "click" );

	jQuery('.items').owlCarousel({

		margin : 20,
		stagePadding : 20,
		loop : true,
		nav : true,
		autoplay : true,
		autoplayTimeout : 3500,
		autoplayHoverPause : true,
		responsive : {
			0 : {
				items : 1,
			},
			480 : {
				items : 2,
			},
			768 : {
				items : 4,
			}
		}
	});
});