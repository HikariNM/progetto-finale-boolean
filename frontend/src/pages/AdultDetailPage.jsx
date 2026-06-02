import { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import axios from 'axios';

export default function AdultDetailPage() {
    const { id } = useParams(); // Recupera l'ID dall'URL
    const [adult, setAdult] = useState(null);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        axios.get(`http://localhost:8000/api/adults/${id}`)
            .then(res => {
                setAdult(res.data.data);
                setLoading(false);
            })
            .catch(err => console.error(err));
    }, [id]);

    if (loading) return <div className="text-center py-5">Caricamento...</div>;

    return (
        <main className="bg-light py-5 mt-5">
            <div className="container">
                <div className="row g-5">
                    <div className="col-lg-6">
                        <img
                            src={adult.image ? `http://localhost:8000/storage/${adult.image}` : 'https://placehold.co/800x600'}
                            alt={adult.name}
                            className="img-fluid rounded shadow"
                        />
                    </div>

                    <div className="col-lg-6">
                        <h1 className="fw-bold text-uppercase">{adult.name}</h1>
                        <h4 className="text-muted mb-4">{adult.titles?.map(t => t.name).join(', ')}</h4>

                        <div className="card shadow-sm my-4">
                            <div className="card-body">
                                <h5 className="card-title">Informazioni</h5>
                                <ul className="list-group list-group-flush">
                                    <li className="list-group-column d-flex justify-content-between">
                                        <strong>Data di nascita:</strong> <span>{adult.birth_date}</span>
                                    </li>
                                    <li className="list-group-column d-flex justify-content-between">
                                        <strong>MDR1:</strong> <span>{adult.mdr1 || 'N.D.'}</span>
                                    </li>
                                    <li className="list-group-column d-flex justify-content-between">
                                        <strong>CEA:</strong> <span>{adult.cea || 'N.D.'}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <p className="lead">{adult.description}</p>
                    </div>
                </div>
            </div>
        </main>
    );
}