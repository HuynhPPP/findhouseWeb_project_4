// Khởi tạo bản đồ
var map = L.map("map").setView([16.0, 108.0], 6); // Tọa độ trung tâm Việt Nam với zoom phù hợp
var marker;

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



// Mặc định chọn OSM
osm.addTo(map);



L.control.addTo(map);

function geocodeAddress(address, callback) {
    const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(
        address
    )}`;

    fetch(url)
        .then((response) => response.json())
        .then((data) => {
            if (data && data.length > 0) {
                const firstResult = data[0];
                const coords = {
                    lat: parseFloat(firstResult.lat),
                    lon: parseFloat(firstResult.lon),
                };
                callback(coords);
            } else {
                callback(null);
            }
        })
        .catch((error) => {
            console.error("Lỗi khi lấy tọa độ:", error);
            Swal.fire({
                title: "Lỗi khi tìm vị trí!",
                text: "Không thể truy cập dịch vụ định vị.",
                icon: "error",
            });
            callback(null);
        });
}

function tryGeocodeVariants(fullAddress, simplifiedAddress, callback) {
    geocodeAddress(fullAddress, function (coords) {
        if (coords) {
            callback(coords); // tìm thấy vị trí đầy đủ
        } else {
            // Thử lại với địa chỉ đã loại bỏ số nhà
            geocodeAddress(simplifiedAddress, function (simpleCoords) {
                if (simpleCoords) {
                    Swal.fire({
                        title: "Địa chỉ không chính xác!",
                        text: "Đã tìm được vị trí gần đúng.",
                        icon: "warning",
                    });
                }
                callback(simpleCoords);
            });
        }
    });
}

function updateMap(lat, lon) {
    // Di chuyển bản đồ đến vị trí mới
    map.setView([lat, lon], 14);

    // Xóa marker cũ nếu có
    if (marker) {
        map.removeLayer(marker);
    }

    // Thêm marker mới
    marker = L.marker([lat, lon]).addTo(map);
}
