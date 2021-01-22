let mymap = L.map('mapid');

L.tileLayer('https://{s}.basemaps.cartocdn.com/light_all/{z}/{x}/{y}{r}.png', {
    attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
    minZoom: 8,
    maxZoom: 18
}).addTo(mymap);

mymap.setView([50.84827657517526, 4.352726141533356], 12);

for (let i = 0; i < data.length; i++) {
    L.marker([data[i].latitude, data[i].longitude]).addTo(mymap).bindPopup(`test`).on('click', function () {
        mymap.panTo(this.getLatLng())
    });
}

function toGoPosition(element) {
    mymap.panTo([parseFloat(element.children.latitude_shop.value), parseFloat(element.children.longitude_shop.value)])
}