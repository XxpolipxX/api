import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';
import LoginPage from './pages/LoginPage';
import RegisterPage from './pages/RegisterPage';
import RedirectToLogin from './utils/RedirectToLogin';
import HomePage from './pages/HomePage';
import checkSession from './hooks/checkSession';
import { useEffect, useState } from 'react';

function App() {
  const [isSessionActive, setIsSessionActive] = useState(null);

  useEffect(() => {
    checkSession().then(setIsSessionActive);
  }, []);
  return (
    <div className="background">
    <BrowserRouter>
      <Routes>
        <Route path="/" element={<RedirectToLogin />} />
        <Route path='/login' element={<LoginPage />}/>
        <Route path="/register" element={<RegisterPage />} />
        <Route
          path="/home"
          element={
            isSessionActive ? <HomePage /> : <Navigate to="/login" replace />
          }
        />
      </Routes>
    </BrowserRouter>
    </div>
  );
}

export default App;