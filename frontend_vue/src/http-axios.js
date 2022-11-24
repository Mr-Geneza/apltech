import axios from "axios";

export default axios.create({
	baseURL: "http://localhost/appltech/backend/api/rest",
	headers: {
		"Content-type": "application/json"
	}	
});