function TIME() {
	let waktu = new Date();
	let date = `${getDayNow(waktu)}, ${waktu.getDate()} ${getMonthNow(
		waktu
	)} ${waktu.getFullYear()}`;
	let time = `${waktu.getHours()}:${waktu.getMinutes()}:${waktu.getSeconds()}`;
	$("#time").html(date + " | " + time);
	$("#time2").html(time);
}

function getMonthNow(waktu) {
	let bulan = [
		"Jan",
		"Feb",
		"Mar",
		"Apr",
		"Mei",
		"Jun",
		"Jul",
		"Agu",
		"Sept",
		"Okt",
		"Nov",
		"Des",
	];
	return bulan[waktu.getMonth()];
}

function getDayNow(waktu) {
	let Day = ["Ahad", "Senin", "Selasa", "Rabu", "Kamis", "Jum'at", "Sabtu"];
	return Day[waktu.getDay()];
}

setInterval(TIME, 10);

$("#date").html(
	(
		new Date().getDate() +
		" " +
		new Date().getMonth("m") +
		" " +
		new Date().getFullYear()
	).toUpperCase()
);

/*=============================================== SELECT TGL, BLN & THN ===============================================*/
var select_tgl = "";
let newAngka = "";
for (let i = 1; i <= new Date().getDate(); i++) {
	if (i >= 1 && i <= 9) {
		newAngka = "0" + i;
	} else {
		newAngka = i;
	}

	if (i == new Date().getDate()) {
		select_tgl += `<option value='${newAngka}' selected>${newAngka}</option>`;
		break;
	}
	select_tgl += `<option value='${newAngka}'>${newAngka}</option>`;
}

$("#select_tgl").html(select_tgl);

let select_bln = "";
let month = [
	{ name: "January", nmFull: "Januari" },
	{ name: "February", nmFull: "Februari" },
	{ name: "March", nmFull: "Maret" },
	{ name: "April", nmFull: "April" },
	{ name: "May", nmFull: "Mei" },
	{ name: "June", nmFull: "Juni" },
	{ name: "July", nmFull: "Juli" },
	{ name: "August", nmFull: "Agustus" },
	{ name: "September", nmFull: "September" },
	{ name: "October", nmFull: "Oktober" },
	{ name: "November", nmFull: "November" },
	{ name: "Desember", nmFull: "Desember" },
];

for (let i = 0; i <= new Date().getMonth(); i++) {
	if (i == new Date().getMonth()) {
		select_bln += `<option value='${month[i].name}' selected>${month[i].nmFull}</option>`;
		break;
	}
	select_bln += `<option value='${month[i].name}'>${month[i].nmFull}</option>`;
}

$("#select_bln").html(select_bln);

let select_thn = `<option value='${new Date().getFullYear()}'>${new Date().getFullYear()}</option>`;
$("#select_thn").html(select_thn);



/*=============================================== SELECT KELAS & JURUSAN ===============================================*/
// let dataJurusan_X = ["KGSP", "BKP", "DPIB1", "DPIB2", "DITF", "TP", "TPKI","TL", "TMI", "TKRO1", "TKRO2", "TBSM1", "TBSM2", "TBSM3", "TBO"];
// let dataJurusan_XI = ["KGSP","BKP","DPIB1","DPIB2","DITF","TITL","TP","TL","TMI","TKRO","TBSM1","TBSM2","TBO", "TO", "RPL1", "RPL2", "TKJ", "MM", "DG"];
// let dataJurusan_XII = ["KGSP", "BKP", "DPIB1", "DPIB2", "DITF", "TITL", "TP", "TL", "TMI", "TKRO", "TBSM", "TBO", "TO", "RPL1", "RPL2", "TKJ", "MM", "DG"];
// let dataJurusan_XIII = ["KGSP","DITF"];

// function dataJurusan(kelas) {
// 	let data = "";
// 	if (kelas == "XI")
// 		for (let i = 0; i < dataJurusan_XI.length; i++) data += `<option value='${dataJurusan_XI[i]}'>${dataJurusan_XI[i]}</option>`;
// 	else if (kelas == "XII") 
// 		for (let i = 0; i < dataJurusan_XII.length; i++) data += `<option value='${dataJurusan_XII[i]}'>${dataJurusan_XII[i]}</option>`;
// 	else if (kelas == "XIII") 
// 		for (let i = 0; i < dataJurusan_XIII.length; i++) data += `<option value='${dataJurusan_XIII[i]}'>${dataJurusan_XIII[i]}</option>`;
// 	else
// 		for (let i = 0; i < dataJurusan_X.length; i++) data += `<option value='${dataJurusan_X[i]}'>${dataJurusan_X[i]}</option>`;

// 	$("#select_jurusan").html(data)
// }

// dataJurusan()

// $("select.set_jurusan").html(dataJurusanX)
$("span#search").click(() => { $("#form_search").submit() })

