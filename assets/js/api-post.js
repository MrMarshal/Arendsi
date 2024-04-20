const base_url = "http://localhost/sinergia/web/arendsi/api/";
//const base_url = "https://drjuanjerezano.com/v2/api/";

async function api_post(url,data) {
	const response = await fetch(base_url+url,{
		method: "POST",
		body: JSON.stringify(data)
	});
	return response.json();
}

async function api_post_file(url,file,data) {
    return new Promise(function(resolve, reject) {
        let formData = new FormData();
        formData.append('file', file);
        for (var key in data)  formData.append(key, data[key]);
        $.ajax({
            url: base_url+url,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                resolve(JSON.parse(response));
            }
        });
    });
}

async function api_select(select_id,url,data) {
	const response = await fetch(base_url+url,{
		method: "POST",
		body: JSON.stringify(data)
	});
	response.json().then(res=>{
        let select_s = "";
        res.forEach(r => {
            select_s+=`<option value="${r.id}">${r.name}</option>`;
        });
        $("#"+select_id).html(select_s);
    });
}