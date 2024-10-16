import axios from "axios";
import https from "https";
// Biến tạm để lưu token trong bộ nhớ
let token = null;
const httpsAgent = new https.Agent({
    rejectUnauthorized: false, // (NOTE: this will disable client verification)
});
// Hàm để lấy token từ API
const fetchToken = async () => {
    try {
        const response = await axios.post(`${process.env.BASE_URL}/api/token?key=${process.env.API_KEY}`);
        const { access_token } = response.data;
        // Lưu token vào biến tạm
        token = access_token;
        return access_token;
    }
    catch (error) {
        console.error("Error fetching token:", error);
        throw error;
    }
};
// Hàm để làm mới token từ API /api/refresh
const refreshToken = async () => {
    try {
        const response = await axios.post(`${process.env.BASE_URL}/api/refresh`);
        const { access_token } = response.data;
        // Cập nhật token trong biến tạm
        token = access_token;
        return access_token;
    }
    catch (error) {
        console.error("Error refreshing token:", error);
        throw error;
    }
};
// Tạo instance của axios
const instance = axios.create({
    baseURL: process.env.BASE_URL,
    httpsAgent,
});
// Interceptor để thêm token vào tất cả các request
instance.interceptors.request.use(async (config) => {
    // Nếu token chưa có, gọi hàm fetchToken để lấy token
    if (!token) {
        token = await fetchToken();
    }
    // Thêm token vào header Authorization
    config.headers.Authorization = `Bearer ${token}`;
    return config;
}, (error) => {
    return Promise.reject(error);
});
// Interceptor để xử lý khi token hết hạn (lỗi 401) và làm mới token
instance.interceptors.response.use((response) => response, async (error) => {
    const originalRequest = error.config;
    // Kiểm tra nếu lỗi 401 do token hết hạn và chưa được retry
    if (error.response &&
        error.response.status === 401 &&
        !originalRequest._retry) {
        originalRequest._retry = true;
        // Làm mới token
        const newToken = await refreshToken();
        // Cập nhật lại header Authorization với token mới
        originalRequest.headers.Authorization = `Bearer ${newToken}`;
        // Thực hiện lại request ban đầu
        return instance(originalRequest);
    }
    return Promise.reject(error);
});
export default instance;
