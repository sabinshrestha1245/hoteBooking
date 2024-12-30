
const rooms = [
    { type: "Standard Twin", bed: "Twin Beds", size: "20m²", facilities: "Wi-Fi, TV", price: "$100", maxPersons: 2 },
    { type: "Executive Twin", bed: "Twin Beds", size: "25m²", facilities: "Wi-Fi, TV, Minibar", price: "$150", maxPersons: 2 },
    { type: "Superior Suite", bed: "King Bed", size: "30m²", facilities: "Wi-Fi, TV, Ocean View", price: "$200", maxPersons: 3 },
    { type: "Deluxe Suite", bed: "King Bed", size: "35m²", facilities: "Wi-Fi, TV, Minibar, Balcony", price: "$250", maxPersons: 3 },
    { type: "Executive Suite", bed: "King Bed", size: "40m²", facilities: "Wi-Fi, TV, Mountain View", price: "$300", maxPersons: 3 },
    { type: "Presidential Suite", bed: "King Bed", size: "50m²", facilities: "Wi-Fi, TV, Jacuzzi", price: "$500", maxPersons: 5 }
];

document.addEventListener("DOMContentLoaded", () => {
    const roomList = document.getElementById("room-list");

    if (roomList) {
        rooms.forEach((room, index) => {
            const roomCard = document.createElement("div");
            roomCard.className = "room-card";
            roomCard.innerHTML = `
                <h3>${room.type}</h3>
                <p>Bed: ${room.bed}</p>
                <p>Size: ${room.size}</p>
                <p>Facilities: ${room.facilities}</p>
                <p>Price: ${room.price}</p>
                <button onclick="checkAvailability(${index})">Check Availability</button>
                <button onclick="bookNow(${index})">Book Now</button>
            `;
            roomList.appendChild(roomCard);
        });
    }
});
