
document.addEventListener("DOMContentLoaded", function () {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
    } else {
        alert("المتصفح لا يدعم تحديد الموقع الجغرافي");
    }

    let map;

    function successCallback(position) {
        const latitude = position.coords.latitude;
        const longitude = position.coords.longitude;

        map = L.map('map').setView([latitude, longitude], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>'
        }).addTo(map);

        L.marker([latitude, longitude])
            .addTo(map)
            .bindPopup("📍 أنت هنا")
            .openPopup();

        fetch(`/api/nearby-properties?lat=${latitude}&long=${longitude}`)
            .then(response => response.json())
            .then(result => {
                if (result.length > 0) {
                    result.forEach(property => {
                        if (property.latitude && property.longitude) {
                            L.marker([property.latitude, property.longitude])
                                .addTo(map)
                                .bindPopup(`
                                            <div style="min-width:220px; font-family:Tahoma, sans-serif; text-align:right;">
                                                ${property.images && property.images.length > 0
                                        ? `<img src="/property_images/${property.images[0].path}" 
                                                            alt="${property.title}" 
                                                            style="width:100%; height:120px; object-fit:cover; border-radius:6px; margin-bottom:8px;" />`
                                        : ''
                                    }
                                                <h4 style="margin:0; color:#2c3e50;">${property.title ?? 'عقار بدون عنوان'}</h4>
                                                <p style="margin:4px 0; font-size:14px; color:#555;">
                                                    🏷️ النوع: ${property.type ?? 'غير محدد'}<br>
                                                    🎯 الغرض: ${property.purpose ?? 'غير محدد'}<br>
                                                    📍 المنطقة: ${property.area ?? ''}, محافظة ${property.gov ?? ''}<br>
                                                    🛏️ الغرف: ${property.rooms ?? 0}<br>
                                                    🏢 الدور: ${property.level ?? ''}<br>
                                                    💵 السعر: ${property.price?.toLocaleString() ?? 'غير محدد'} ج.م<br>
                                                    💳 الدفع: ${property.payment ?? 'غير محدد'}<br>
                                                    📏 المسافة: ${property.distance ? property.distance.toFixed(2) + ' كم' : ''} 
                                                </p>
                                                ${property.location_url
                                        ? `<a href="${property.location_url}" target="_blank" style="color:#2980b9; text-decoration:none;">📌 فتح على الخريطة</a>`
                                        : ''}
                                            </div>
                                        `);
                        }
                    });
                }
            })
            .catch(error => {
                console.error("Error fetching properties:", error);
            });
    }

    function errorCallback(error) {
        let mapDiv = document.getElementById("map");
        mapDiv.innerHTML = `
        <div style="display:flex; align-items:center; justify-content:center; height:100%; text-align:center; font-family:Tahoma, sans-serif; color:#c0392b; background:#f9ecec; border:1px solid #e0b4b4; border-radius:8px; padding:20px;">
            <div>
                <h3>⚠️ لم يتم تحديد الموقع</h3>
                <p style="font-size:14px; color:#555;">
                    ${error.code === error.PERMISSION_DENIED
                ? "لم يتم منح صلاحية الوصول للموقع. من فضلك فعّل الموقع من إعدادات المتصفح."
                : error.code === error.POSITION_UNAVAILABLE
                    ? "تعذر الحصول على معلومات الموقع. حاول مرة أخرى."
                    : error.code === error.TIMEOUT
                        ? "انتهت مهلة تحديد الموقع. حاول مرة أخرى."
                        : "حدث خطأ غير متوقع أثناء تحديد الموقع."}
                </p>
            </div>
        </div>
    `;
    }
    if (navigator.permissions) {
        navigator.permissions.query({ name: 'geolocation' }).then(function (permissionStatus) {
            permissionStatus.onchange = function () {
                if (permissionStatus.state === "granted") {
                    navigator.geolocation.getCurrentPosition(successCallback, errorCallback);
                }
            };
        });
    }
});