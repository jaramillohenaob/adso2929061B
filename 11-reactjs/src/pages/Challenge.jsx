import { useState, useEffect } from "react";
import {
  Routes,
  Route,
  useNavigate,
  useLocation,
} from "react-router-dom";
import Swal from "sweetalert2";

/* ─── API CONFIG ─────────────────────────────────────────────────────────── */
const API_URL = "http://127.0.0.1:8000/api";

const getToken = () => localStorage.getItem("token");

const mapPetFromApi = (pet = {}) => ({
  id: pet.id,
  nombre: pet.nombre ?? pet.name ?? "",
  tipo: pet.tipo ?? pet.kind ?? "",
  peso: pet.peso ?? pet.weight ?? "",
  edad: pet.edad ?? pet.age ?? "",
  raza: pet.raza ?? pet.breed ?? "",
  ubicacion: pet.ubicacion ?? pet.location ?? "",
  foto: pet.foto ?? pet.image ?? "",
  descripcion: pet.descripcion ?? pet.description ?? "",
  activo: pet.activo ?? pet.active ?? 1,
  adoptado: pet.adoptado ?? pet.adopted ?? 0,
});

const mapPetToApi = (form = {}) => ({
  name: form.nombre ?? form.name ?? "",
  kind: form.tipo ?? form.kind ?? "",
  weight: form.peso ?? form.weight ?? "",
  age: form.edad ?? form.age ?? "",
  breed: form.raza ?? form.breed ?? "",
  location: form.ubicacion ?? form.location ?? "",
  description: form.descripcion ?? form.description ?? "Sin descripción",
  active: form.activo ?? form.active ?? 1,
  adopted: form.adoptado ?? form.adopted ?? 0,
});

const apiFetch = async (path, options = {}) => {
  const token = getToken();
  const res = await fetch(`${API_URL}${path}`, {
    ...options,
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
      ...(token ? { Authorization: `Bearer ${token}` } : {}),
      ...(options.headers || {}),
    },
  });

  if (!res.ok) {
    const error = await res.json().catch(() => ({ message: "Error en el servidor" }));
    throw new Error(error.message || `Error ${res.status}`);
  }

  // 204 No Content (DELETE) no trae body
  if (res.status === 204) return null;
  return res.json();
};

/* ─── ICONOS SVG ─────────────────────────────────────────────────────────── */
const PawIcon = ({ size = 32, color = "currentColor" }) => (
  <svg xmlns="http://www.w3.org/2000/svg" width={size} height={size} fill={color} viewBox="0 0 256 256">
    <path d="M212,80a28,28,0,1,0,28,28A28,28,0,0,0,212,80Zm0,40a12,12,0,1,1,12-12A12,12,0,0,1,212,120ZM72,108a28,28,0,1,0-28,28A28,28,0,0,0,72,108ZM44,120a12,12,0,1,1,12-12A12,12,0,0,1,44,120ZM92,88A28,28,0,1,0,64,60,28,28,0,0,0,92,88Zm0-40A12,12,0,1,1,80,60,12,12,0,0,1,92,48Zm72,40a28,28,0,1,0-28-28A28,28,0,0,0,164,88Zm0-40a12,12,0,1,1-12,12A12,12,0,0,1,164,48Zm23.12,100.86a35.3,35.3,0,0,1-16.87-21.14,44,44,0,0,0-84.5,0A35.25,35.25,0,0,1,69,148.82,40,40,0,0,0,88,224a39.48,39.48,0,0,0,15.52-3.13,64.09,64.09,0,0,1,48.87,0,40,40,0,0,0,34.73-72ZM168,208a24,24,0,0,1-9.45-1.93,80.14,80.14,0,0,0-61.19,0,24,24,0,0,1-20.71-43.26,51.22,51.22,0,0,0,24.46-30.67,28,28,0,0,1,53.78,0,51.27,51.27,0,0,0,24.53,30.71A24,24,0,0,1,168,208Z" />
  </svg>
);

const CirclesIcon = ({ size = 28, color = "currentColor" }) => (
  <svg xmlns="http://www.w3.org/2000/svg" width={size} height={size} fill={color} viewBox="0 0 256 256">
    <path d="M80,40a40,40,0,1,0,40,40A40,40,0,0,0,80,40Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,80,104Zm96,16a40,40,0,1,0-40-40A40,40,0,0,0,176,120Zm0-64a24,24,0,1,1-24,24A24,24,0,0,1,176,56ZM80,136a40,40,0,1,0,40,40A40,40,0,0,0,80,136Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,80,200Zm96-64a40,40,0,1,0,40,40A40,40,0,0,0,176,136Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,176,200Z" />
  </svg>
);

const PlusIcon = ({ size = 20, color = "currentColor" }) => (
  <svg xmlns="http://www.w3.org/2000/svg" width={size} height={size} fill={color} viewBox="0 0 256 256">
    <path d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z" />
  </svg>
);

const SignOutIcon = ({ size = 18, color = "currentColor" }) => (
  <svg xmlns="http://www.w3.org/2000/svg" width={size} height={size} fill={color} viewBox="0 0 256 256">
    <path d="M120,216a8,8,0,0,1-8,8H48a8,8,0,0,1-8-8V40a8,8,0,0,1,8-8h64a8,8,0,0,1,0,16H56V208h56A8,8,0,0,1,120,216Zm109.66-93.66-40-40a8,8,0,0,0-11.32,11.32L204.69,120H112a8,8,0,0,0,0,16h92.69l-26.35,26.34a8,8,0,0,0,11.32,11.32l40-40A8,8,0,0,0,229.66,122.34Z" />
  </svg>
);

const SearchIcon = ({ size = 16, color = "currentColor" }) => (
  <svg xmlns="http://www.w3.org/2000/svg" width={size} height={size} fill={color} viewBox="0 0 256 256">
    <path d="M229.66,218.34l-50.07-50.06a88.11,88.11,0,1,0-11.31,11.31l50.06,50.07a8,8,0,0,0,11.32-11.32ZM40,112a72,72,0,1,1,72,72A72.08,72.08,0,0,1,40,112Z" />
  </svg>
);

const PencilIcon = ({ size = 16, color = "currentColor" }) => (
  <svg xmlns="http://www.w3.org/2000/svg" width={size} height={size} fill={color} viewBox="0 0 256 256">
    <path d="M227.31,73.37,182.63,28.68a16,16,0,0,0-22.63,0L36.69,152A15.86,15.86,0,0,0,32,163.31V208a16,16,0,0,0,16,16H92.69A15.86,15.86,0,0,0,104,219.31L227.31,96a16,16,0,0,0,0-22.63ZM92.69,208H48V163.31l88-88L180.69,120ZM192,108.68,147.31,64l24-24L216,84.68Z" />
  </svg>
);

const TrashIcon = ({ size = 16, color = "currentColor" }) => (
  <svg xmlns="http://www.w3.org/2000/svg" width={size} height={size} fill={color} viewBox="0 0 256 256">
    <path d="M216,48H40a8,8,0,0,0,0,16h8V208a16,16,0,0,0,16,16H192a16,16,0,0,0,16-16V64h8a8,8,0,0,0,0-16ZM192,208H64V64H192ZM80,24a8,8,0,0,1,8-8h80a8,8,0,0,1,0,16H88A8,8,0,0,1,80,24Z" />
  </svg>
);

const BackIcon = ({ size = 20, color = "currentColor" }) => (
  <svg xmlns="http://www.w3.org/2000/svg" width={size} height={size} fill={color} viewBox="0 0 256 256">
    <path d="M128,24A104,104,0,1,0,232,128,104.11,104.11,0,0,0,128,24Zm0,192a88,88,0,1,1,88-88A88.1,88.1,0,0,1,128,216Zm48-88a8,8,0,0,1-8,8H107.31l18.35,18.34a8,8,0,0,1-11.32,11.32l-32-32a8,8,0,0,1,0-11.32l32-32a8,8,0,0,1,11.32,11.32L107.31,120H168A8,8,0,0,1,176,128Z" />
  </svg>
);

/* ─── COMPONENTES REUTILIZABLES ─────────────────────────────────────────── */

function Header({ title, onBack }) {
  return (
    <div className="flex items-center gap-3 px-4 py-3" style={{ background: "#494D31" }}>
      <button
        onClick={onBack}
        className="flex items-center justify-center w-8 h-8 rounded-full border-2 border-[#C9CDB1] shrink-0"
        aria-label="Volver"
      >
        <BackIcon size={18} color="#C9CDB1" />
      </button>
      <h1 className="flex-1 text-right text-xl font-semibold" style={{ color: "#C9CDB1" }}>
        {title}
      </h1>
    </div>
  );
}

function ReadField({ label, value }) {
  return (
    <div className="mb-3">
      <p className="text-sm font-semibold mb-1" style={{ color: "#C9CDB1" }}>{label}</p>
      <div className="rounded-lg px-3 py-2 text-sm" style={{ background: "#7a8250", color: "#C9CDB1" }}>
        {value || "—"}
      </div>
    </div>
  );
}

function FormField({ label, name, value, onChange, type = "text" }) {
  return (
    <div className="mb-3">
      <label className="block text-sm font-semibold mb-1" style={{ color: "#494D31" }}>
        {label}
      </label>
      <input
        type={type}
        name={name}
        value={value}
        onChange={onChange}
        className="w-full rounded-lg px-3 py-2 text-sm outline-none"
        style={{ background: "#939B63", color: "#C9CDB1" }}
      />
    </div>
  );
}

function IconBtn({ children, onClick, label }) {
  return (
    <button
      onClick={onClick}
      aria-label={label}
      className="flex items-center justify-center w-8 h-8 rounded-md"
      style={{ background: "rgba(201,205,177,0.2)", border: "1px solid rgba(201,205,177,0.4)" }}
    >
      {children}
    </button>
  );
}

// Spinner simple para estados de carga
function Spinner() {
  return (
    <div className="flex flex-col items-center justify-center h-full gap-3" style={{ background: "#C9CDB1" }}>
      <div
        className="w-10 h-10 rounded-full border-4 border-t-transparent animate-spin"
        style={{ borderColor: "#494D31", borderTopColor: "transparent" }}
      />
      <p className="text-sm" style={{ color: "#494D31" }}>Cargando...</p>
    </div>
  );
}

/* ─── VISTAS ─────────────────────────────────────────────────────────────── */

const petUi = {
  screen: {
    width: 360,
    height: 640,
    overflow: "hidden",
    background: "#C9CDB1",
    color: "#494D31",
    fontFamily: "Poppins, sans-serif",
  },
  header: {
    height: 44,
    display: "flex",
    alignItems: "center",
    gap: 12,
    background: "#494D31",
    padding: "0 10px 0 14px",
    boxSizing: "border-box",
  },
  title: {
    flex: 1,
    margin: 0,
    color: "#C9CDB1",
    textAlign: "right",
    fontSize: 29,
    fontWeight: 400,
    lineHeight: 1,
  },
  panel: {
    background: "#939B63",
    borderRadius: 8,
    boxSizing: "border-box",
  },
  label: {
    display: "block",
    margin: "0 0 4px",
    color: "#C9CDB1",
    fontSize: 21,
    fontWeight: 300,
    lineHeight: 1,
  },
  field: {
    width: "100%",
    height: 31,
    border: 0,
    borderRadius: 8,
    outline: "none",
    background: "#494D31",
    color: "#C9CDB1",
    fontSize: 14,
    fontWeight: 300,
    padding: "0 11px",
    boxSizing: "border-box",
  },
};

function PetTopBar({ title, onBack }) {
  return (
    <header style={petUi.header}>
      <button
        type="button"
        onClick={onBack}
        aria-label="Volver"
        style={{
          width: 30,
          height: 30,
          display: "flex",
          alignItems: "center",
          justifyContent: "center",
          border: "2px solid #C9CDB1",
          borderRadius: "50%",
          background: "transparent",
          padding: 0,
          cursor: "pointer",
        }}
      >
        <BackIcon size={21} color="#C9CDB1" />
      </button>
      <h1 style={petUi.title}>{title}</h1>
    </header>
  );
}

function PetInput({ label, name, value, onChange, type = "text" }) {
  return (
    <div style={{ marginBottom: 7 }}>
      <label style={petUi.label}>{label}</label>
      <input
        type={type}
        name={name}
        value={value}
        onChange={onChange}
        style={petUi.field}
      />
    </div>
  );
}

function PetRead({ label, value }) {
  return (
    <div style={{ marginBottom: 10 }}>
      <p style={petUi.label}>{label}</p>
      <div style={{ ...petUi.field, display: "flex", alignItems: "center" }}>
        {value || ""}
      </div>
    </div>
  );
}

function PetActionButton({ children, variant = "solid", disabled, onClick }) {
  const isOutline = variant === "outline";
  return (
    <button
      type="button"
      onClick={onClick}
      disabled={disabled}
      style={{
        minWidth: 116,
        height: 40,
        border: isOutline ? "2px solid #494D31" : 0,
        borderRadius: 8,
        background: isOutline ? "transparent" : "#494D31",
        color: isOutline ? "#494D31" : "#C9CDB1",
        cursor: disabled ? "not-allowed" : "pointer",
        fontSize: 25,
        fontWeight: 400,
        lineHeight: 1,
        opacity: disabled ? 0.6 : 1,
      }}
    >
      {children}
    </button>
  );
}

function LoginView({ onLogin }) {
  const [form, setForm] = useState({ email: "", password: "" });
  const [loading, setLoading] = useState(false);

  const handleChange = (e) =>
    setForm((f) => ({ ...f, [e.target.name]: e.target.value }));

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!form.email || !form.password) {
      Swal.fire({
        icon: "warning",
        title: "Campos requeridos",
        text: "Por favor ingresa tu correo y contrasena.",
        confirmButtonColor: "#494D31",
      });
      return;
    }
    setLoading(true);
    try {
      const data = await apiFetch("/login", {
        method: "POST",
        body: JSON.stringify({ email: form.email, password: form.password }),
      });
      localStorage.setItem("token", data.token ?? data.access_token ?? data.data?.token);
      onLogin();
    } catch (err) {
      Swal.fire({
        icon: "error",
        title: "Error al iniciar sesion",
        text: err.message || "Credenciales incorrectas.",
        confirmButtonColor: "#494D31",
      });
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="relative h-full overflow-hidden bg-[#C9CDB1] px-8 pb-16 pt-8 text-[#494D31]">
      <div className="flex flex-col items-center">
        <PawIcon size={52} color="#494D31" />
        <p className="mt-4 text-3xl font-medium leading-none">¡Welcome!</p>
      </div>

      <img
        src="/black-cat.svg"
        alt="Black cat"
        className="pointer-events-none absolute left-2 top-[138px] z-20 h-[138px] w-[117px] object-contain"
      />

      <section className="relative z-10 mt-24 rounded-lg bg-[#939B63] px-3 pb-6 pt-3">
        <h2 className="mb-11 text-center text-3xl font-medium leading-none text-[#494D31]">
          Larapets
        </h2>

        <div className="absolute inset-x-3 top-[84px] h-[184px] overflow-hidden rounded-lg bg-[#A3AA73] opacity-70">
          <img
            src="/bg-login.svg"
            alt=""
            aria-hidden="true"
            className="mx-auto h-full w-full scale-125 object-contain opacity-75"
          />
        </div>

        <form onSubmit={handleSubmit} noValidate className="relative z-10">
          <div className="mb-7">
            <label className="mb-2 block text-xl font-light leading-none text-[#E5E8D1]">
              Correo
            </label>
            <input
              type="email"
              name="email"
              value={form.email}
              onChange={handleChange}
              className="h-[34px] w-full rounded-lg bg-[#494D31] px-3 text-base text-[#E5E8D1] outline-none ring-2 ring-transparent transition focus:ring-[#C9CDB1]"
              autoComplete="email"
            />
          </div>
          <div className="mb-5">
            <label className="mb-2 block text-xl font-light leading-none text-[#E5E8D1]">
              Contraseña
            </label>
            <input
              type="password"
              name="password"
              value={form.password}
              onChange={handleChange}
              className="h-[34px] w-full rounded-lg bg-[#494D31] px-3 text-base text-[#E5E8D1] outline-none ring-2 ring-transparent transition focus:ring-[#C9CDB1]"
              autoComplete="current-password"
            />
          </div>
          <div className="flex justify-center">
            <button
              type="submit"
              disabled={loading}
              className="min-w-[130px] rounded-lg bg-[#494D31] px-8 py-2 text-xl font-medium leading-none text-[#F1F3E3] transition hover:bg-[#3F432A] disabled:cursor-not-allowed disabled:opacity-60"
            >
              {loading ? "Entrando..." : "Sign In"}
            </button>
          </div>
        </form>
      </section>
    </div>
  );
}

function LoginPixel({ onLogin }) {
  const [form, setForm] = useState({ email: "", password: "" });
  const [loading, setLoading] = useState(false);

  const handleChange = (e) =>
    setForm((f) => ({ ...f, [e.target.name]: e.target.value }));

  const handleSubmit = async (e) => {
    e.preventDefault();
    if (!form.email || !form.password) {
      Swal.fire({
        icon: "warning",
        title: "Campos requeridos",
        text: "Por favor ingresa tu correo y contrasena.",
        confirmButtonColor: "#494D31",
      });
      return;
    }

    setLoading(true);
    try {
      const data = await apiFetch("/login", {
        method: "POST",
        body: JSON.stringify({ email: form.email, password: form.password }),
      });
      localStorage.setItem("token", data.token ?? data.access_token ?? data.data?.token);
      onLogin();
    } catch (err) {
      Swal.fire({
        icon: "error",
        title: "Error al iniciar sesion",
        text: err.message || "Credenciales incorrectas.",
        confirmButtonColor: "#494D31",
      });
    } finally {
      setLoading(false);
    }
  };

  const inputStyle = {
    width: "100%",
    height: 34,
    border: 0,
    borderRadius: 8,
    outline: "none",
    background: "#494D31",
    color: "#C9CDB1",
    fontSize: 16,
    padding: "0 12px",
  };

  const labelStyle = {
    display: "block",
    marginBottom: 5,
    color: "#C9CDB1",
    fontSize: 20,
    fontWeight: 300,
    lineHeight: 1,
  };

  return (
    <div
      style={{
        position: "relative",
        width: 360,
        height: 640,
        overflow: "hidden",
        background: "#C9CDB1",
        color: "#494D31",
        fontFamily: "Poppins, sans-serif",
        padding: "28px 24px 24px",
        boxSizing: "border-box",
      }}
    >
      <div
        style={{
          position: "absolute",
          inset: 0,
          background: "radial-gradient(circle at top left, rgba(255,255,255,0.35), transparent 45%)",
        }}
      />

      <div style={{ position: "relative", zIndex: 2, display: "flex", flexDirection: "column", alignItems: "center" }}>
        <div
          style={{
            width: 64,
            height: 64,
            borderRadius: "50%",
            background: "rgba(73,77,49,0.12)",
            display: "flex",
            alignItems: "center",
            justifyContent: "center",
          }}
        >
          <PawIcon size={42} color="#494D31" />
        </div>
        <p style={{ margin: "12px 0 0", fontSize: 33, fontWeight: 500, lineHeight: 1 }}>
          ¡Welcome!
        </p>
      </div>

      <img
        src="/black-cat.svg"
        alt="Black cat"
        style={{
          position: "absolute",
          left: -2,
          top: 132,
          zIndex: 3,
          width: 122,
          height: 148,
          objectFit: "contain",
          pointerEvents: "none",
          filter: "drop-shadow(0 8px 12px rgba(0,0,0,0.15))",
        }}
      />

      <section
        style={{
          position: "relative",
          zIndex: 2,
          marginTop: 90,
          borderRadius: 24,
          background: "#939B63",
          padding: "22px 18px 20px",
          boxSizing: "border-box",
          boxShadow: "0 12px 28px rgba(0,0,0,0.16)",
        }}
      >
        <h2
          style={{
            margin: "0 0 44px",
            color: "#494D31",
            textAlign: "center",
            fontSize: 32,
            fontWeight: 500,
            lineHeight: 1,
          }}
        >
          Larapets
        </h2>

        <div
          style={{
            position: "absolute",
            left: 14,
            right: 14,
            top: 70,
            height: 185,
            overflow: "hidden",
            borderRadius: 16,
            background: "linear-gradient(135deg, #A8AF76 0%, #91985E 100%)",
            opacity: 0.84,
          }}
        >
          <img
            src="/bg-login.svg"
            alt=""
            aria-hidden="true"
            style={{
              display: "block",
              width: "100%",
              height: "100%",
              objectFit: "contain",
              transform: "scale(1.18)",
              opacity: 0.82,
            }}
          />
        </div>

        <form onSubmit={handleSubmit} noValidate style={{ position: "relative", zIndex: 2 }}>
          <div style={{ marginBottom: 24 }}>
            <label style={labelStyle}>Correo</label>
            <input
              type="email"
              name="email"
              value={form.email}
              onChange={handleChange}
              style={inputStyle}
              autoComplete="email"
              placeholder="correo@email.com"
            />
          </div>
          <div style={{ marginBottom: 22 }}>
            <label style={labelStyle}>Contraseña</label>
            <input
              type="password"
              name="password"
              value={form.password}
              onChange={handleChange}
              style={inputStyle}
              autoComplete="current-password"
              placeholder="••••••••"
            />
          </div>
          <div style={{ display: "flex", justifyContent: "center" }}>
            <button
              type="submit"
              disabled={loading}
              style={{
                minWidth: 136,
                height: 42,
                border: 0,
                borderRadius: 10,
                background: "#494D31",
                color: "#C9CDB1",
                cursor: loading ? "not-allowed" : "pointer",
                fontSize: 20,
                fontWeight: 500,
                lineHeight: 1,
                opacity: loading ? 0.6 : 1,
                boxShadow: "0 8px 16px rgba(73,77,49,0.25)",
              }}
            >
              {loading ? "Entrando..." : "Sign In"}
            </button>
          </div>
        </form>
      </section>
    </div>
  );
}

LoginView.displayName = "LoginView";

/** LOGIN */
function Login({ onLogin }) {
  return <LoginPixel onLogin={onLogin} />;
}

Login.displayName = "Login";

/** DASHBOARD */
function Dashboard({ onLogout }) {
  const navigate = useNavigate();
  const [pets, setPets] = useState([]);
  const [loading, setLoading] = useState(true);

  // Carga la lista al montar
  const fetchPets = async () => {
    setLoading(true);
    try {
      const data = await apiFetch("/pets/list");
      const list = Array.isArray(data.pets)
        ? data.pets
        : (Array.isArray(data) ? data : (data.data ?? []));
      setPets(list.map(mapPetFromApi));
    } catch (err) {
      Swal.fire({
        icon: "error",
        title: "No se pudo cargar la lista",
        text: err.message,
        confirmButtonColor: "#494D31",
      });
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => { fetchPets(); }, []);

  const handleDelete = (pet) => {
    Swal.fire({
      title: `¿Eliminar a ${pet.nombre ?? pet.name}?`,
      text: "Esta acción no se puede deshacer.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#494D31",
      cancelButtonColor: "#939B63",
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar",
    }).then(async (result) => {
      if (!result.isConfirmed) return;
      try {
        await apiFetch(`/pets/delete/${pet.id}`, { method: "DELETE" });
        setPets((prev) => prev.filter((p) => p.id !== pet.id));
        Swal.fire({ icon: "success", title: "Mascota eliminada", timer: 1500, showConfirmButton: false });
      } catch (err) {
        Swal.fire({ icon: "error", title: "Error al eliminar", text: err.message, confirmButtonColor: "#494D31" });
      }
    });
  };

  const handleLogout = () => {
    Swal.fire({
      title: "¿Cerrar sesión?",
      icon: "question",
      showCancelButton: true,
      confirmButtonColor: "#494D31",
      cancelButtonColor: "#939B63",
      confirmButtonText: "Sí, salir",
      cancelButtonText: "Cancelar",
    }).then(async (result) => {
      if (!result.isConfirmed) return;
      try {
        // Llama al endpoint de logout si existe; ignora error si no
        await apiFetch("/logout", { method: "POST" }).catch(() => {});
      } finally {
        localStorage.removeItem("token");
        onLogout();
      }
    });
  };

  if (loading) return <Spinner />;

  return (
    <div className="flex flex-col h-full" style={{ background: "#C9CDB1" }}>
      {/* Encabezado */}
      <div className="flex items-center justify-between px-4 pt-5 pb-3">
        <div className="flex items-center gap-2">
          <CirclesIcon size={28} color="#494D31" />
          <span className="text-xl font-bold" style={{ color: "#494D31" }}>Dashboard</span>
        </div>
        <button
          onClick={handleLogout}
          className="flex items-center gap-1.5 px-3 py-2 rounded-lg text-sm font-semibold"
          style={{ background: "#494D31", color: "#C9CDB1" }}
        >
          <SignOutIcon size={16} color="#C9CDB1" />
          Sign out
        </button>
      </div>

      {/* Botón agregar */}
      <div className="px-4 mb-3">
        <button
          onClick={() => navigate("/challenge/create")}
          className="w-full flex items-center justify-center gap-2 py-3 rounded-xl text-base font-semibold"
          style={{ background: "#494D31", color: "#C9CDB1" }}
        >
          <PlusIcon size={20} color="#C9CDB1" />
          + Pet
        </button>
      </div>

      <p className="text-center text-sm font-medium mb-2" style={{ color: "#494D31" }}>
        Lista de mascotas
      </p>

      {/* Lista */}
      <div className="flex-1 mx-4 mb-4 rounded-xl overflow-y-auto p-2" style={{ background: "#939B63" }}>
        {pets.length === 0 ? (
          <p className="text-center text-sm py-8" style={{ color: "#C9CDB1" }}>
            No hay mascotas aún. ¡Agrega una!
          </p>
        ) : (
          pets.map((pet) => (
            <div
              key={pet.id}
              className="flex items-center gap-3 p-2.5 mb-2 rounded-xl"
              style={{ background: "rgba(201,205,177,0.15)" }}
            >
              <div
                className="w-12 h-12 rounded-lg shrink-0 flex items-center justify-center text-xl"
                style={{ background: "#C9CDB1" }}
              >
                {pet.foto
                  ? <img src={pet.foto} alt={pet.nombre ?? pet.name} className="w-full h-full object-cover rounded-lg" />
                  : "🐾"}
              </div>
              <div className="flex-1 min-w-0">
                <p className="font-semibold text-sm truncate" style={{ color: "#C9CDB1" }}>
                  {pet.nombre ?? pet.name}
                </p>
                <p className="text-xs opacity-75 truncate" style={{ color: "#C9CDB1" }}>
                  {pet.tipo ?? pet.kind} · {pet.raza ?? pet.breed}
                </p>
              </div>
              <div className="flex gap-1.5 shrink-0">
                <IconBtn label="Ver" onClick={() => navigate(`/challenge/show/${pet.id}`)}>
                  <SearchIcon size={15} color="#C9CDB1" />
                </IconBtn>
                <IconBtn label="Editar" onClick={() => navigate(`/challenge/update/${pet.id}`)}>
                  <PencilIcon size={15} color="#C9CDB1" />
                </IconBtn>
                <IconBtn label="Eliminar" onClick={() => handleDelete(pet)}>
                  <TrashIcon size={15} color="#C9CDB1" />
                </IconBtn>
              </div>
            </div>
          ))
        )}
      </div>
    </div>
  );
}

/** CREATE PET */
function LegacyCreatePet() {
  const navigate = useNavigate();
  const [form, setForm] = useState({ nombre: "", tipo: "", peso: "", edad: "", raza: "", ubicacion: "" });
  const [loading, setLoading] = useState(false);

  const handleChange = (e) =>
    setForm((f) => ({ ...f, [e.target.name]: e.target.value }));

  const handleCreate = async () => {
    if (!form.nombre.trim() || !form.tipo.trim()) {
      Swal.fire({ icon: "warning", title: "Campos requeridos", text: "Nombre y tipo son obligatorios.", confirmButtonColor: "#494D31" });
      return;
    }
    setLoading(true);
    try {
      await apiFetch("/pets/store", {
        method: "POST",
        body: JSON.stringify(mapPetToApi(form)),
      });
      Swal.fire({ icon: "success", title: "¡Mascota creada!", timer: 1500, showConfirmButton: false })
        .then(() => navigate("/challenge/dashboard"));
    } catch (err) {
      Swal.fire({ icon: "error", title: "Error al crear", text: err.message, confirmButtonColor: "#494D31" });
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="flex flex-col h-full" style={{ background: "#C9CDB1" }}>
      <Header title="Create Pet" onBack={() => navigate("/challenge/dashboard")} />
      <div className="flex-1 overflow-y-auto px-4 py-4">
        <FormField label="Nombre"    name="nombre"    value={form.nombre}    onChange={handleChange} />
        <FormField label="Tipo"      name="tipo"      value={form.tipo}      onChange={handleChange} />
        <FormField label="Peso"      name="peso"      value={form.peso}      onChange={handleChange} type="number" />
        <FormField label="Edad"      name="edad"      value={form.edad}      onChange={handleChange} type="number" />
        <FormField label="Raza"      name="raza"      value={form.raza}      onChange={handleChange} />
        <FormField label="Ubicación" name="ubicacion" value={form.ubicacion} onChange={handleChange} />
      </div>
      <div className="flex gap-3 px-4 py-3" style={{ background: "#C9CDB1", borderTop: "1px solid rgba(73,77,49,0.2)" }}>
        <button
          onClick={() => navigate("/challenge/dashboard")}
          className="flex-1 py-3 rounded-xl text-base font-semibold border-2"
          style={{ borderColor: "#494D31", color: "#494D31", background: "transparent" }}
        >
          Cancelar
        </button>
        <button
          onClick={handleCreate}
          disabled={loading}
          className="flex-1 py-3 rounded-xl text-base font-semibold disabled:opacity-60"
          style={{ background: "#494D31", color: "#C9CDB1" }}
        >
          {loading ? "Creando..." : "Crear"}
        </button>
      </div>
    </div>
  );
}

/** SHOW PET */
function LegacyShowPet() {
  const navigate = useNavigate();
  const location = useLocation();
  const id = location.pathname.split("/").pop();

  const [pet, setPet] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    apiFetch(`/pets/show/${id}`)
      .then((data) => setPet(mapPetFromApi(data.pet ?? data.data ?? data)))
      .catch((err) =>
        Swal.fire({ icon: "error", title: "Error", text: err.message, confirmButtonColor: "#494D31" })
      )
      .finally(() => setLoading(false));
  }, [id]);

  if (loading) return <Spinner />;

  if (!pet) {
    return (
      <div className="flex flex-col h-full" style={{ background: "#C9CDB1" }}>
        <Header title="Show Pet" onBack={() => navigate("/challenge/dashboard")} />
        <p className="text-center mt-8 text-sm" style={{ color: "#494D31" }}>Mascota no encontrada.</p>
      </div>
    );
  }

  return (
    <div className="flex flex-col h-full" style={{ background: "#C9CDB1" }}>
      <Header title="Show Pet" onBack={() => navigate("/challenge/dashboard")} />
      <div className="flex-1 overflow-y-auto px-4 py-4">
        {/* Foto */}
        <div className="flex justify-center mb-4">
          <div className="w-36 h-36 rounded-xl flex items-center justify-center text-5xl" style={{ background: "#939B63" }}>
            {pet.foto
              ? <img src={pet.foto} alt={pet.nombre ?? pet.name} className="w-full h-full object-cover rounded-xl" />
              : "🐾"}
          </div>
        </div>
        {/* Detalle */}
        <div className="rounded-xl p-4" style={{ background: "#939B63" }}>
          <ReadField label="Nombre" value={pet.nombre ?? pet.name} />
          <div className="grid grid-cols-2 gap-3">
            <ReadField label="Tipo"  value={pet.tipo  ?? pet.kind}  />
            <ReadField label="Peso"  value={pet.peso  ?? pet.weight} />
            <ReadField label="Edad"  value={pet.edad  ?? pet.age}   />
            <ReadField label="Raza"  value={pet.raza  ?? pet.breed} />
          </div>
          <ReadField label="Ubicación" value={pet.ubicacion ?? pet.location} />
        </div>
      </div>
    </div>
  );
}

/** UPDATE PET */
function LegacyUpdatePet() {
  const navigate = useNavigate();
  const location = useLocation();
  const id = location.pathname.split("/").pop();

  const [form, setForm] = useState(null);
  const [loading, setLoading] = useState(true);
  const [saving, setSaving] = useState(false);

  useEffect(() => {
    apiFetch(`/pets/show/${id}`)
      .then((data) => {
        const p = mapPetFromApi(data.pet ?? data.data ?? data);
        setForm({
          nombre:    p.nombre,
          tipo:      p.tipo,
          peso:      p.peso,
          edad:      p.edad,
          raza:      p.raza,
          ubicacion: p.ubicacion,
        });
      })
      .catch((err) =>
        Swal.fire({ icon: "error", title: "Error", text: err.message, confirmButtonColor: "#494D31" })
      )
      .finally(() => setLoading(false));
  }, [id]);

  const handleChange = (e) =>
    setForm((f) => ({ ...f, [e.target.name]: e.target.value }));

  const handleUpdate = async () => {
    if (!form.nombre?.trim() || !form.tipo?.trim()) {
      Swal.fire({ icon: "warning", title: "Campos requeridos", text: "Nombre y tipo son obligatorios.", confirmButtonColor: "#494D31" });
      return;
    }
    setSaving(true);
    try {
      await apiFetch(`/pets/edit/${id}`, {
        method: "PUT",
        body: JSON.stringify(mapPetToApi(form)),
      });
      Swal.fire({ icon: "success", title: "¡Mascota actualizada!", timer: 1500, showConfirmButton: false })
        .then(() => navigate("/challenge/dashboard"));
    } catch (err) {
      Swal.fire({ icon: "error", title: "Error al actualizar", text: err.message, confirmButtonColor: "#494D31" });
    } finally {
      setSaving(false);
    }
  };

  if (loading) return <Spinner />;

  if (!form) {
    return (
      <div className="flex flex-col h-full" style={{ background: "#C9CDB1" }}>
        <Header title="Update Pet" onBack={() => navigate("/challenge/dashboard")} />
        <p className="text-center mt-8 text-sm" style={{ color: "#494D31" }}>Mascota no encontrada.</p>
      </div>
    );
  }

  return (
    <div className="flex flex-col h-full" style={{ background: "#C9CDB1" }}>
      <Header title="Update Pet" onBack={() => navigate("/challenge/dashboard")} />
      <div className="flex-1 overflow-y-auto px-4 py-4">
        <FormField label="Nombre"    name="nombre"    value={form.nombre}    onChange={handleChange} />
        <FormField label="Tipo"      name="tipo"      value={form.tipo}      onChange={handleChange} />
        <FormField label="Peso"      name="peso"      value={form.peso}      onChange={handleChange} type="number" />
        <FormField label="Edad"      name="edad"      value={form.edad}      onChange={handleChange} type="number" />
        <FormField label="Raza"      name="raza"      value={form.raza}      onChange={handleChange} />
        <FormField label="Ubicación" name="ubicacion" value={form.ubicacion} onChange={handleChange} />
      </div>
      <div className="flex gap-3 px-4 py-3" style={{ background: "#C9CDB1", borderTop: "1px solid rgba(73,77,49,0.2)" }}>
        <button
          onClick={() => navigate("/challenge/dashboard")}
          className="flex-1 py-3 rounded-xl text-base font-semibold border-2"
          style={{ borderColor: "#494D31", color: "#494D31", background: "transparent" }}
        >
          Cancelar
        </button>
        <button
          onClick={handleUpdate}
          disabled={saving}
          className="flex-1 py-3 rounded-xl text-base font-semibold disabled:opacity-60"
          style={{ background: "#494D31", color: "#C9CDB1" }}
        >
          {saving ? "Guardando..." : "Actualizar"}
        </button>
      </div>
    </div>
  );
}

/* ─── COMPONENTE PRINCIPAL ──────────────────────────────────────────────── */
LegacyCreatePet.displayName = "LegacyCreatePet";
LegacyShowPet.displayName = "LegacyShowPet";
LegacyUpdatePet.displayName = "LegacyUpdatePet";

function CreatePet() {
  const navigate = useNavigate();
  const [form, setForm] = useState({ nombre: "", tipo: "", peso: "", edad: "", raza: "", ubicacion: "" });
  const [loading, setLoading] = useState(false);

  const handleChange = (e) =>
    setForm((f) => ({ ...f, [e.target.name]: e.target.value }));

  const handleCreate = async () => {
    if (!form.nombre.trim() || !form.tipo.trim()) {
      Swal.fire({ icon: "warning", title: "Campos requeridos", text: "Nombre y tipo son obligatorios.", confirmButtonColor: "#494D31" });
      return;
    }
    setLoading(true);
    try {
      await apiFetch("/pets/store", { method: "POST", body: JSON.stringify(mapPetToApi(form)) });
      Swal.fire({ icon: "success", title: "Mascota creada", timer: 1500, showConfirmButton: false })
        .then(() => navigate("/challenge/dashboard"));
    } catch (err) {
      Swal.fire({ icon: "error", title: "Error al crear", text: err.message, confirmButtonColor: "#494D31" });
    } finally {
      setLoading(false);
    }
  };

  return (
    <div style={petUi.screen}>
      <PetTopBar title="Create Pet" onBack={() => navigate("/challenge/dashboard")} />
      <main style={{ padding: "26px 24px 0" }}>
        <section style={{ ...petUi.panel, padding: "22px 10px 17px" }}>
          <PetInput label="Nombre" name="nombre" value={form.nombre} onChange={handleChange} />
          <PetInput label="Tipo" name="tipo" value={form.tipo} onChange={handleChange} />
          <PetInput label="Peso" name="peso" value={form.peso} onChange={handleChange} type="number" />
          <PetInput label="Edad" name="edad" value={form.edad} onChange={handleChange} type="number" />
          <PetInput label="Raza" name="raza" value={form.raza} onChange={handleChange} />
          <PetInput label="Ubicación" name="ubicacion" value={form.ubicacion} onChange={handleChange} />
        </section>
        <div style={{ display: "flex", justifyContent: "center", gap: 17, marginTop: 19 }}>
          <PetActionButton variant="outline" onClick={() => navigate("/challenge/dashboard")}>
            Cancelar
          </PetActionButton>
          <PetActionButton disabled={loading} onClick={handleCreate}>
            {loading ? "..." : "Crear"}
          </PetActionButton>
        </div>
      </main>
    </div>
  );
}

function ShowPet() {
  const navigate = useNavigate();
  const location = useLocation();
  const id = location.pathname.split("/").pop();
  const [pet, setPet] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    apiFetch(`/pets/${id}`)
      .then((data) => setPet(data.data ?? data))
      .catch((err) =>
        Swal.fire({ icon: "error", title: "Error", text: err.message, confirmButtonColor: "#494D31" })
      )
      .finally(() => setLoading(false));
  }, [id]);

  if (loading) return <Spinner />;

  if (!pet) {
    return (
      <div style={petUi.screen}>
        <PetTopBar title="Show Pet" onBack={() => navigate("/challenge/dashboard")} />
        <p style={{ marginTop: 32, textAlign: "center", color: "#494D31" }}>Mascota no encontrada.</p>
      </div>
    );
  }

  const photo = pet.foto ?? pet.photo ?? pet.image ?? pet.picture;

  return (
    <div style={petUi.screen}>
      <PetTopBar title="Show Pet" onBack={() => navigate("/challenge/dashboard")} />
      <main style={{ padding: "26px 17px 0" }}>
        <section style={{ ...petUi.panel, minHeight: 444, padding: "10px 8px 16px" }}>
          <div style={{ display: "flex", justifyContent: "center", marginBottom: 12 }}>
            <div style={{ width: 134, height: 124, borderRadius: 8, background: "#494D31", padding: 9, boxSizing: "border-box" }}>
              {photo ? (
                <img src={photo} alt={pet.nombre ?? pet.name ?? "Mascota"} style={{ width: "100%", height: "100%", objectFit: "cover", display: "block" }} />
              ) : (
                <img src="/bg-login.svg" alt="" style={{ width: "100%", height: "100%", objectFit: "contain", display: "block" }} />
              )}
            </div>
          </div>

          <PetRead label="Nombre" value={pet.nombre ?? pet.name} />
          <div style={{ display: "grid", gridTemplateColumns: "1fr 1fr", gap: 8 }}>
            <PetRead label="Tipo" value={pet.tipo ?? pet.kind} />
            <PetRead label="Peso" value={pet.peso ?? pet.weight} />
            <PetRead label="Edad" value={pet.edad ?? pet.age} />
            <PetRead label="Raza" value={pet.raza ?? pet.breed} />
          </div>
          <PetRead label="Ubicación" value={pet.ubicacion ?? pet.location} />
        </section>
      </main>
    </div>
  );
}

function UpdatePet() {
  const navigate = useNavigate();
  const location = useLocation();
  const id = location.pathname.split("/").pop();
  const [form, setForm] = useState(null);
  const [loading, setLoading] = useState(true);
  const [saving, setSaving] = useState(false);

  useEffect(() => {
    apiFetch(`/pets/show/${id}`)
      .then((data) => {
        const p = mapPetFromApi(data.pet ?? data.data ?? data);
        setForm({
          nombre: p.nombre,
          tipo: p.tipo,
          peso: p.peso,
          edad: p.edad,
          raza: p.raza,
          ubicacion: p.ubicacion,
        });
      })
      .catch((err) =>
        Swal.fire({ icon: "error", title: "Error", text: err.message, confirmButtonColor: "#494D31" })
      )
      .finally(() => setLoading(false));
  }, [id]);

  const handleChange = (e) =>
    setForm((f) => ({ ...f, [e.target.name]: e.target.value }));

  const handleUpdate = async () => {
    if (!form.nombre?.trim() || !form.tipo?.trim()) {
      Swal.fire({ icon: "warning", title: "Campos requeridos", text: "Nombre y tipo son obligatorios.", confirmButtonColor: "#494D31" });
      return;
    }
    setSaving(true);
    try {
      await apiFetch(`/pets/edit/${id}`, { method: "PUT", body: JSON.stringify(mapPetToApi(form)) });
      Swal.fire({ icon: "success", title: "Mascota actualizada", timer: 1500, showConfirmButton: false })
        .then(() => navigate("/challenge/dashboard"));
    } catch (err) {
      Swal.fire({ icon: "error", title: "Error al actualizar", text: err.message, confirmButtonColor: "#494D31" });
    } finally {
      setSaving(false);
    }
  };

  if (loading) return <Spinner />;

  if (!form) {
    return (
      <div style={petUi.screen}>
        <PetTopBar title="Update Pet" onBack={() => navigate("/challenge/dashboard")} />
        <p style={{ marginTop: 32, textAlign: "center", color: "#494D31" }}>Mascota no encontrada.</p>
      </div>
    );
  }

  return (
    <div style={petUi.screen}>
      <PetTopBar title="Update Pet" onBack={() => navigate("/challenge/dashboard")} />
      <main style={{ padding: "26px 24px 0" }}>
        <section style={{ ...petUi.panel, padding: "22px 10px 17px" }}>
          <PetInput label="Nombre" name="nombre" value={form.nombre} onChange={handleChange} />
          <PetInput label="Tipo" name="tipo" value={form.tipo} onChange={handleChange} />
          <PetInput label="Peso" name="peso" value={form.peso} onChange={handleChange} type="number" />
          <PetInput label="Edad" name="edad" value={form.edad} onChange={handleChange} type="number" />
          <PetInput label="Raza" name="raza" value={form.raza} onChange={handleChange} />
          <PetInput label="Ubicación" name="ubicacion" value={form.ubicacion} onChange={handleChange} />
        </section>
        <div style={{ display: "flex", justifyContent: "center", gap: 17, marginTop: 19 }}>
          <PetActionButton variant="outline" onClick={() => navigate("/challenge/dashboard")}>
            Cancelar
          </PetActionButton>
          <PetActionButton disabled={saving} onClick={handleUpdate}>
            {saving ? "..." : "Actualizar"}
          </PetActionButton>
        </div>
      </main>
    </div>
  );
}

function Challenge() {
  // Arranca ya logueado si hay token guardado
  const [isLoggedIn, setIsLoggedIn] = useState(!!localStorage.getItem("token"));

  const handleLogin  = () => setIsLoggedIn(true);
  const handleLogout = () => setIsLoggedIn(false);

  return (
    <div
      style={{
        minHeight: "100vh",
        display: "flex",
        alignItems: "center",
        justifyContent: "center",
        background: "#1a1a1a",
      }}
    >
      <div style={{ position: "relative", width: 360, height: 640, overflow: "hidden" }}>
        {!isLoggedIn ? (
          <LoginPixel onLogin={handleLogin} />
        ) : (
          <Routes>
            <Route index element={<Dashboard onLogout={handleLogout} />} />
            <Route path="dashboard" element={<Dashboard onLogout={handleLogout} />} />
            <Route path="create" element={<CreatePet />} />
            <Route path="show/:id" element={<ShowPet />} />
            <Route path="update/:id" element={<UpdatePet />} />
          </Routes>
        )}
      </div>
    </div>
  );
}

export default Challenge;
