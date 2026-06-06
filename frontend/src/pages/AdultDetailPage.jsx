import { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';
import { Link } from 'react-router-dom';
import axios from 'axios';

export default function AdultDetailPage() {
    const { id } = useParams(); // Recupera l'ID dall'URL
    const [adult, setAdult] = useState(null);
    const [allLitter, setAllLitter] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        axios.get(`http://localhost:8000/api/adults/${id}`)
            .then(res => {
                setAdult(res.data.data);
                setAllLitter([...res.data.data.litters_as_father,
                ...res.data.data.litters_as_mother
                ])
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

                        <div className="mt-4">
                            <h4>Cucciolate Correlate</h4>
                            {allLitter && allLitter.length > 0 ? (
                                <ul className="list-group">
                                    {allLitter.map((litter) => (
                                        <li key={litter.id} className="list-group-item">
                                            <Link to={`/cucciolate/${litter.id}`} className="text-decoration-none text-dark" >
                                                {litter.title}
                                            </Link>
                                        </li>
                                    ))}
                                </ul>
                            ) : (
                                <p className="text-muted">Nessuna cucciolata registrata.</p>
                            )}
                        </div>
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
                                        <strong>Allevatore:</strong> <span>{adult.breeder?.charAt(0).toUpperCase() + adult.breeder?.slice(1) || 'N.D'}</span>
                                    </li>
                                    <li className="list-group-column d-flex justify-content-between">
                                        <strong>Proprietario:</strong> <span>{adult.owner?.charAt(0).toUpperCase() + adult.owner?.slice(1) || 'N.D'}</span>
                                    </li>
                                    <li className="list-group-column d-flex justify-content-between">
                                        <strong>Colore:</strong> <span>{adult.coat_color}</span>
                                    </li>
                                    <li className="list-group-column d-flex justify-content-between">
                                        <strong>Stato in allevamento:</strong> <span>{adult.status === 'Attivo' ? 'Disponibile per monte' : 'Ritirato'}</span>
                                    </li>

                                    <h5 className="card-title mt-3">Test Genetici</h5>
                                    {adult.genetic_tests && adult.genetic_tests.length > 0 ? (

                                        adult.genetic_tests?.map((test) => (
                                            <li key={test.id} className="list-group-column d-flex justify-content-between">
                                                <strong>{test.name}:</strong> <span>{test.pivot?.result || 'N.D.'}</span>
                                            </li>)
                                        ))
                                        : (
                                            <li className="list-group-column d-flex justify-content-between">
                                                <span>Test non ancora effettuati</span>
                                            </li>
                                        )}
                                </ul>
                            </div>
                        </div>
                        <div>
                            <p className="lead">{adult.description}</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    );
}