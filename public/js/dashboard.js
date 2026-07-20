// ==========================================
// SC RISK PLATFORM DASHBOARD JS
// ==========================================


// ===============================
// GLOBAL VARIABLES
// ===============================

let countriesData = [];
let riskChart = null;


// ===============================
// INITIALIZE MAP
// ===============================

let map = L.map('map').setView([20,0],2);


L.tileLayer(
    'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
    {
        maxZoom:19,
        attribution:'© OpenStreetMap'
    }
).addTo(map);



// ===============================
// LOAD ALL DASHBOARD DATA
// ===============================

async function loadDashboard(){

    try{


        let response = await fetch('/api/risk-generate-all');

        let result = await response.json();


        countriesData = result.data;



        console.log(
            "DATA NEGARA:",
            countriesData
        );


        updateKPI();

        loadMap();

        loadChart();

        loadCountryDropdown();


    }
    catch(error){

        console.error(
            "Dashboard Error:",
            error
        );

    }

}



// ===============================
// UPDATE KPI CARD
// ===============================

function updateKPI(){


    let total =
    countriesData.reduce(
        (sum,item)=>
        sum + item.score,
        0
    );


    let average =
    total / countriesData.length;



    document.getElementById(
        "kpi-global-risk"
    ).innerHTML =
    `
    <h5>Global Risk Score (Avg)</h5>
    <h2>${average.toFixed(1)}</h2>
    `;



    document.getElementById(
        "kpi-countries"
    ).innerHTML =
    `
    <h5>Countries Monitored</h5>
    <h2>${countriesData.length}</h2>
    `;



    let alert =
    countriesData.filter(
        c=>c.score>=60
    ).length;



    document.getElementById(
        "kpi-alerts"
    ).innerHTML =
    `
    <h5>Active Alerts</h5>
    <h2>${alert}</h2>
    `;



    document.getElementById(
        "kpi-ports"
    ).innerHTML =
    `
    <h5>Ports Monitored</h5>
    <h2>1256</h2>
    `;


}



// ===============================
// MAP COUNTRY MARKER
// ===============================


function loadMap(){


    let location={

        "Indonesia":[-6.2,106.8],
        "China":[35.8,104.1],
        "Japan":[36.2,138.2],
        "India":[20.5,78.9],
        "Singapore":[1.35,103.8],
        "Malaysia":[4.2,101.9]

    };



    countriesData.forEach(country=>{


        let pos =
        location[country.country];



        if(pos){


            L.circleMarker(
                pos,
                {

                    radius:10,

                    color:
                    country.score>=60
                    ?
                    "red"
                    :
                    country.score>=40
                    ?
                    "orange"
                    :
                    "green",

                    fillOpacity:.8

                }

            )

            .addTo(map)

            .bindPopup(

                `
                <b>${country.country}</b>
                <br>
                Score :
                ${country.score}

                <br>

                Status :
                ${country.status}

                `

            );

        }



    });



}



// ===============================
// CHART
// ===============================


function loadChart(){


let ctx =
document
.getElementById(
"riskTrendChart"
)
.getContext("2d");



if(riskChart){

riskChart.destroy();

}



riskChart =
new Chart(
ctx,
{


type:"line",


data:{


labels:
countriesData.map(
c=>c.country
),


datasets:[{


label:
"Risk Score",


data:
countriesData.map(
c=>c.score
),


borderColor:
"#00ffff",


backgroundColor:
"rgba(0,255,255,.2)",


fill:true



}]

},



options:{


responsive:true,


scales:{


y:{


beginAtZero:true,

max:100

}


}



}


}

);



}





// ==================================================
// COUNTRY DASHBOARD
// ==================================================


function loadCountryDropdown(){


let select =
document.getElementById(
"countrySelect"
);



if(!select)
return;



select.innerHTML="";



countriesData.forEach(
country=>{


let option =
document.createElement(
"option"
);


option.value =
country.country;


option.text =
country.country;



select.appendChild(
option
);



});



showCountry(
countriesData[0].country
);



select.onchange=function(){

showCountry(
this.value
);


}



}





async function showCountry(country){



try{


let response =
await fetch(
`/api/risk/${country}`
);



let data =
await response.json();



console.log(
"COUNTRY DETAIL",
data
);



let risk =
data.risk;



document.getElementById(
"countryData"
).innerHTML =

`

<div class="row">


<div class="col-md-4">

<div class="card-kpi">

<h4>${country}</h4>

<h2>
${risk.total_score}
</h2>

<p>
Status :
${risk.status}
</p>


</div>

</div>



<div class="col-md-8">


<div class="card-kpi">


<h4>
Risk Detail
</h4>


<table class="table table-dark">

<tr>
<td>Weather Risk</td>
<td>${risk.weather_risk}</td>
</tr>


<tr>
<td>Inflation Risk</td>
<td>${risk.inflation_risk}</td>
</tr>



<tr>
<td>Currency Risk</td>
<td>${risk.currency_risk}</td>
</tr>



<tr>
<td>News Risk</td>
<td>${risk.news_risk}</td>
</tr>


</table>


</div>


</div>


</div>

`;



}

catch(error){


console.log(error);


}

}



// ===============================
// MENU NAVIGATION
// ===============================


document
.querySelectorAll(
".sidebar a"
)
.forEach(
menu=>{


menu.onclick=function(){



document
.querySelectorAll(
".sidebar a"
)
.forEach(
x=>x.classList.remove(
"active"
)
);



this.classList.add(
"active"
);



let target =
this.dataset.target;



document
.querySelectorAll(
".menu-section"
)
.forEach(
section=>
section.classList.remove(
"active"
)
);



document
.getElementById(
target
)
.classList.add(
"active"
);



}

});



// ===============================
// START APPLICATION
// ===============================

loadDashboard();