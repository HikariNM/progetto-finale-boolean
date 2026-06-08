import { useState } from 'react';
import { Link } from 'react-router-dom';
import logo from '../assets/ico.png'

export default function Navbar() {
    const [isOpen, setIsOpen] = useState(false);
    // const [isDropdownOpen, setIsDropdownOpen] = useState(false);
    const [openDropdown, setOpenDropdown] = useState(null);

    const closeMenu = () => {
        setIsOpen(false);
        setOpenDropdown(false);
    };

    return (
        <nav className="navbar navbar-expand-lg navbar-dark bg-dark fixed-top px-3">
            <div className="container-fluid">
                <Link className="navbar-brand" to="/" onClick={closeMenu}>
                    <img src={logo} alt="starbound logo" style={{ height: '40px' }} />
                </Link>

                <button
                    className="navbar-toggler"
                    type="button"
                    onClick={() => setIsOpen(!isOpen)}
                    aria-controls="navbarNav"
                    aria-expanded={isOpen}
                    aria-label="Toggle navigation"
                >
                    <span className="navbar-toggler-icon"></span>
                </button>

                <div className={`collapse navbar-collapse ${isOpen ? 'show' : ''}`} id="navbarNav">
                    <ul className="navbar-nav ms-auto">
                        <li className="nav-item">
                            <Link className="nav-link" to="/" onClick={closeMenu}>HomePage</Link>
                        </li>
                        <li className={`nav-item dropdown ${openDropdown === 'litters' ? 'show' : ''}`}>
                            <a
                                className="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                onClick={(e) => { e.preventDefault(); setOpenDropdown(openDropdown === 'litters' ? null : 'litters'); }}
                            >
                                Cucciolate
                            </a>
                            <ul className={`dropdown-menu dropdown-menu-dark ${openDropdown === 'litters' ? 'show' : ''}`}>
                                <li>
                                    <Link className="dropdown-menu-item dropdown-item" to="/cucciolate/in-programma" onClick={closeMenu}>
                                        In Programma
                                    </Link>
                                </li>
                                <li>
                                    <Link className="dropdown-menu-item dropdown-item" to="/cucciolate/passate" onClick={closeMenu}>
                                        Cucciolate Passate
                                    </Link>
                                </li>
                            </ul>
                        </li>

                        <li className={`nav-item dropdown ${openDropdown === 'dogs' ? 'show' : ''}`}>
                            <a
                                className="nav-link dropdown-toggle"
                                href="#"
                                role="button"
                                onClick={(e) => { e.preventDefault(); setOpenDropdown(openDropdown === 'dogs' ? null : 'dogs'); }}
                            >
                                I nostri cani
                            </a>
                            <ul className={`dropdown-menu dropdown-menu-dark ${openDropdown === 'dogs' ? 'show' : ''}`}>
                                <li>
                                    <Link className="dropdown-menu-item dropdown-item" to="/i-nostri-cani/stalloni" onClick={closeMenu}>
                                        Stalloni
                                    </Link>
                                </li>
                                <li>
                                    <Link className="dropdown-menu-item dropdown-item" to="/i-nostri-cani/fattrici" onClick={closeMenu}>
                                        Fattrici
                                    </Link>
                                </li>
                            </ul>
                        </li>
                        <li className="nav-item">
                            <Link className="nav-link" to="/cuccioli-disponibili" onClick={closeMenu}>Cuccioli disponibili</Link>
                        </li>

                        {/* <li className="nav-item">
                            <Link className="nav-link" to="/gallery" onClick={closeMenu}>Gallery</Link>
                        </li> */}
                        <li className="nav-item">
                            <Link className="nav-link" to="/la-razza" onClick={closeMenu}>La razza</Link>
                        </li>
                        {/* <li className="nav-item">
                            <Link className="nav-link" to="/latest-news" onClick={closeMenu}>Latest news</Link>
                        </li> */}
                    </ul>
                </div>
            </div>
        </nav>
    );
}