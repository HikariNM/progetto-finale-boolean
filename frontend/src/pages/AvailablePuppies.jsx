import { useEffect, useState } from 'react';
import axios from 'axios';
import PuppyCard from '../components/PuppyCard';

export default function AvailablePuppies({ status }) {

    const [puppies, setPuppies] = useState([]);
    // State to manage loading status
    const [loading, setLoading] = useState(true);
    // State to manage server errors
    const [error, setError] = useState(null);

    useEffect(() => {
        setLoading(true);
        setError(null);

        axios.get(`${import.meta.env.VITE_API_URL}/api/puppies`)
            .then((response) => {
                setPuppies(response.data.data);
                // console.log(response.data.data);
                setLoading(false);
            })
            .catch((err) => {
                console.error("Error fetching adults:", err);
                setError("Impossibile caricare i cuccioli. Riprova più tardi.");
                setLoading(false);
            });

    }, [status]);


    return (
        <main className="bg-white text-dark min-vh-100 py-5 mt-5">

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

            {!loading && !error && puppies.length === 0 && (
                <div className="container text-center my-5">
                    <p className="text-muted">Al momento non ci sono cuccioli da mostrare in questa sezione.</p>
                </div>
            )}

            {!loading && !error && puppies.length > 0 && (
                <div className="container">
                    {puppies.map((puppy, index) => (
                        <PuppyCard
                            key={puppy.id}
                            puppy={puppy}
                            index={index}
                        />
                    ))}
                </div>
            )}
        </main>
    )

}