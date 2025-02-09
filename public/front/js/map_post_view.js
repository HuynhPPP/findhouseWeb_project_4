// Tọa bản đồ Việt Nam
var map = L.map('map').setView([16.0, 108.0], 6); // Tọa độ trung tâm Việt Nam với zoom phù hợp

// Base layers (các lớp bản đồ nền)
var osm = L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
  attribution: "&copy; OpenStreetMap contributors",
});

var satellite = L.tileLayer(
  "https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}",
  {
    subdomains: ["mt0", "mt1", "mt2", "mt3"],
    attribution: "&copy; Google Maps",
  }
);

var dark = L.tileLayer(
  "https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png",
  {
    attribution: "&copy; CartoDB",
  }
);

// Mặc định chọn OSM
osm.addTo(map);

// Các lớp (overlay) như đường ranh giới
var boundary = L.polygon(
  [
    [10.0552, 105.7369],
    [10.0352, 105.7469],
    [10.0452, 105.7669],
    [10.0652, 105.7569],
  ],
  {
    color: "red",
    weight: 3,
    fillColor: "rgba(255, 0, 0, 0.2)",
  }
).addTo(map);

// Control để chọn layer
var baseMaps = {
  "Mặc định (OSM)": osm,
  "Vệ tinh (Google)": satellite,
  "Tối (Dark Mode)": dark,
};

var overlayMaps = {
  "Viền Cần Thơ": boundary,
};

L.control.layers(baseMaps, overlayMaps).addTo(map);
