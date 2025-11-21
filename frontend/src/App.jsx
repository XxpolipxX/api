import { BrowserRouter, Routes, Route, Navigate } from 'react-router-dom';
import LoginPage from './pages/LoginPage';
import RegisterPage from './pages/RegisterPage';
import HomePage from './pages/HomePage';
import SessionGate from './components/SessionGate';

export default function App() {
  return (
    <div className="background">
      <BrowserRouter>
        <SessionGate>
          {(isSessionActive, setIsSessionActive) => (
            <Routes>
              <Route path="/" element={<Navigate to={isSessionActive ? "/home" : "/login"} replace />} />
              <Route
                path="/login"
                element={
                  isSessionActive ? (
                    <Navigate to="/home" replace />
                  ) : (
                    <LoginPage setSessionActive={setIsSessionActive} />
                  )
                }
              />
              <Route
                path="/register"
                element={
                  isSessionActive ? (
                    <Navigate to="/home" replace />
                  ) : (
                    <RegisterPage setSessionActive={setIsSessionActive} />
                  )
                }
              />
              <Route
                path="/home"
                element={
                  isSessionActive ? (
                    <HomePage setSessionActive={setIsSessionActive} />
                  ) : (
                    <Navigate to="/login" replace />
                  )
                }
              />
            </Routes>
          )}
        </SessionGate>
      </BrowserRouter>
    </div>
  );
}