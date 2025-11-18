import { BrowserRouter, Routes, Route } from 'react-router-dom';
import LoginPage from './pages/LoginPage';
import RegisterPage from './pages/RegisterPage';
import RedirectToLogin from './utils/RedirectToLogin';

function App() {
  return (
    <div className="background">
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<RedirectToLogin />} />
        <Route path='/login' element={<LoginPage />}/>
        <Route path="/register" element={<RegisterPage />} />
      </Routes>
    </BrowserRouter>
    </div>
  );
}

export default App;