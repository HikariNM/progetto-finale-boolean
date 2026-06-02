import { Link } from 'react-router-dom';

export default function Footer() {
    return (
        <footer className="bg-dark text-white pt-5 pb-3 mt-auto">
            <div className="container">
                <div className="row g-4">

                    <div className="col-md-4 text-white-50">
                        <h5 className="text-uppercase text-white fw-bold mb-3 font-monospace">Starbound Kennel</h5>
                        <p className="mb-1 small">Via dell'Allevamento, 12, Roma (RM)</p>
                        <p className="mb-1 small">+39 333 123 4567</p>
                        <p className="mb-3 small">info@starboundkennel.com</p>

                        <div className="d-flex gap-3 fs-5">
                            <a href="https://facebook.com" className="text-white text-decoration-none" target="_blank" rel="noopener noreferrer">
                                <span className="badge bg-secondary">FB</span>
                            </a>
                            <a href="https://instagram.com" className="text-white text-decoration-none" target="_blank" rel="noopener noreferrer">
                                <span className="badge bg-secondary">IG</span>
                            </a>
                        </div>
                    </div>

                    <div className="col-md-4">
                        <h5 className="text-uppercase fw-bold mb-3 font-monospace">I Nostri Servizi</h5>
                        <ul className="list-unstyled text-white-50 small">
                            <li className="mb-2">Allevamento Australian Shepherd</li>
                            <li className="mb-2">Selezione Morfologica e Caratteriale</li>
                            <li className="mb-2">Screening Genetici Completi</li>
                            <li className="mb-2">Consegna Cuccioli con Pedigree</li>
                            <li className="mb-2">Assistenza Post-Affido Continuativa</li>
                        </ul>
                    </div>

                    <div className="col-md-4 text-md-end text-start">
                        <h5 className="text-uppercase fw-bold mb-3 font-monospace">Allevamento Certificato</h5>
                        <p className="small text-white-50">Riconosciuto ufficialmente dai massimi enti cinofili:</p>
                        <div className="d-flex justify-content-md-end justify-content-start gap-3 mt-2">
                            <div className="bg-light text-dark p-2 rounded fw-bold small text-center" style={{ width: '70px', height: '40px', lineHeight: '24px' }}>
                                ENCI
                            </div>
                            <div className="bg-light text-dark p-2 rounded fw-bold small text-center" style={{ width: '70px', height: '40px', lineHeight: '24px' }}>
                                FCI
                            </div>
                        </div>
                    </div>

                </div>


                <hr className="my-4 border-light" />

                {/* Copyright, Copyright Note & GDPR Row */}
                <div className="row text-white-50 small">
                    {/* Left: Image copyright notice (from your example image_8c74e3.png) */}
                    <div className="col-md-6 text-md-start text-center mb-3 mb-md-0">
                        <p className="mb-1">
                            Le immagini e le foto contenute nel sito sono di proprietà esclusiva di
                            <strong> Starbound Kennel</strong>. Ne è vietato qualsiasi tipo di riproduzione e utilizzo senza esplicito consenso.
                        </p>
                        <p className="mb-0">P.IVA: 01234567890</p> {/* Replace with your real VAT number if applicable */}
                    </div>

                    {/* Right: Technical Copyright & Legal Links */}
                    <div className="col-md-6 text-md-end text-center d-flex flex-column justify-content-center align-items-md-end">
                        <p className="mb-1">
                            &copy; {new Date().getFullYear()} Starbound Kennel. All Rights Reserved. Affisso ENCI/FCI.
                        </p>
                        <div className="legal-links">
                            <a href="/privacy-policy" className="text-white-50 text-decoration-underline me-3">Privacy Policy</a>
                            <a href="/cookie-policy" className="text-white-50 text-decoration-underline">Cookie Policy</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    );
}