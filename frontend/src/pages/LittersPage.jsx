import { useEffect, useState } from 'react';
import axios from 'axios';
import LitterCard from '../components/LitterCard';

export default function LittersPage({ type }) {
    // State to store the litters fetched from the database
    const [litters, setLitters] = useState([]);
    // State to manage loading status
    const [loading, setLoading] = useState(true);
    // State to manage server errors
    const [error, setError] = useState(null);

    // Determine if the current page should show upcoming projects
    const isUpcoming = type === 'upcoming';

    useEffect(() => {
        // Reset loading status on every route or type change
        setLoading(true);
        setError(null);

        axios.get(`http://localhost:8000/api/litters`, {
            params: { status: type } // Send 'upcoming' or 'past' to the Laravel controller
        })
            .then((response) => {
                setLitters(response.data.data);
                setLoading(false);
            })
            .catch((err) => {
                console.error("Error fetching litters:", err);
                setError("Impossibile caricare le cucciolate. Riprova più tardi.");
                setLoading(false);
            });

    }, [type]); // The effect re-runs automatically if the user changes page in the Navbar

    return (
        <main className="bg-white text-dark min-vh-100 py-5 mt-5">
            <section className="container mb-5 pt-4">
                <div className="row justify-content-center text-center">
                    <div className="col-lg-8">
                        <h1 className="display-4 fw-bold text-uppercase tracking-wide border-bottom pb-3 mb-3">
                            {isUpcoming ? 'Cucciolate In Programma' : 'Cucciolate Passate'}
                        </h1>
                        <p className="lead text-muted">
                            {isUpcoming
                                ? "I nostri progetti futuri per la selezione dell'Australian Shepherd."
                                : "Le storie e i cuccioli nati nel nostro allevamento."}
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

            {!loading && !error && litters.length === 0 && (
                <div className="container text-center my-5">
                    <p className="text-muted">Al momento non ci sono cucciolate da mostrare in questa sezione.</p>
                </div>
            )}

            {!loading && !error && litters.length > 0 && (
                <div className="container">
                    {litters.map((litter, index) => (
                        <LitterCard
                            key={litter.id}
                            litter={litter}
                            index={index}
                            isUpcoming={isUpcoming}
                        />
                    ))}
                </div>
            )}
        </main>
    );
}