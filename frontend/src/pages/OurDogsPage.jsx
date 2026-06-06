import { useEffect, useState } from 'react';
import axios from 'axios';
import AdultCard from '../components/AdultCard'; // Assicurati di creare questo componente

export default function AdultsPage({ gender }) {
    // State to store the adults fetched from the database
    const [adults, setAdults] = useState([]);
    // State to manage loading status
    const [loading, setLoading] = useState(true);
    // State to manage server errors
    const [error, setError] = useState(null);

    const isMale = gender === 'male';

    useEffect(() => {
        // Reset loading status on every route or gender change
        setLoading(true);
        setError(null);

        axios.get(`${import.meta.env.VITE_API_URL}/api/adults`, {
            params: { gender: gender } // Send 'male' or 'female' to the controller
        })
            .then((response) => {
                setAdults(response.data.data);
                setLoading(false);
            })
            .catch((err) => {
                console.error("Error fetching adults:", err);
                setError("Impossibile caricare i cani. Riprova più tardi.");
                setLoading(false);
            });

    }, [gender]);

    return (
        <main className="bg-white text-dark min-vh-100 py-5 mt-5">
            <section className="container mb-5 pt-4">
                <div className="row justify-content-center text-center">
                    <div className="col-lg-8">
                        <h1 className="display-4 fw-bold text-uppercase tracking-wide border-bottom pb-3 mb-3">
                            {isMale ? 'I Nostri Stalloni' : 'Le Nostre Fattrici'}
                        </h1>
                        <p className="lead text-muted">
                            {isMale
                                ? "Scopri i nostri stalloni selezionati per morfologia e carattere."
                                : "Le nostre fattrici, pilastri del nostro allevamento."}
                        </p>
                    </div>
                </div>
            </section>

            {loading && (
                <div className="container text-center my-5">
                    <div className="spinner-border text-dark" role="status">
                        <span className="visually-hidden">Caricamento...</span>
                    </div>
                </div>
            )}

            {error && (
                <div className="container text-center my-5">
                    <p className="text-danger fw-bold">{error}</p>
                </div>
            )}

            {!loading && !error && adults.length === 0 && (
                <div className="container text-center my-5">
                    <p className="text-muted">Al momento non ci sono cani da mostrare in questa sezione.</p>
                </div>
            )}

            {!loading && !error && adults.length > 0 && (
                <div className="container">
                    {adults.map((adult, index) => (
                        <AdultCard
                            key={adult.id}
                            adult={adult}
                            index={index}
                        />
                    ))}
                </div>
            )}
        </main>
    );
}