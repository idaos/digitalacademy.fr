var chart_data = {

	"2021": [

		{ 

			"value": "93", 

			"course": "" 

		}

	],

}


var chart_wrp = document.getElementById("chart-wrp");

Object.keys(chart_data).forEach(function(key, idx, arr) {

	var toggle_arrow = createElementWithClass("div", "toggable-btn");
	toggle_arrow.innerHTML = "Découvrir la satisfaction de nos clients en " + key;
	var toggle_content = createElementWithClass("div", "toggable-content");
	var chart_year = createElementWithClass("div", "year");
	var chart_year_val = createElementWithClass("h3", "value");
	chart_year_val.innerHTML = "Taux de satisfaction de nos apprenants en 2021<br><div class='average-93' style='display: block;margin-bottom: 1rem;margin-top: 2rem;height: 91px;width: 91px;line-height: 91px;'>0%</div><span>Taux d'abandon de nos apprenants en 2021</span>";
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
		var triangle = '';
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
	// toggle_content.appendChild(chart_items);
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